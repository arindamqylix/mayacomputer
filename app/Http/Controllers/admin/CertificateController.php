<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\center\Certificate;
use App\Models\center\Student;
use Carbon\Carbon;

class CertificateController extends Controller
{
    // List all certificates (admin panel)
    public function certificate_list()
    {
        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code'
            )
            ->orderBy('student_certificates.sc_id', 'DESC')
            ->get();

        return view('admin.certificate.index', compact('certificates'));
    }

    // Generate certificate page (admin panel)
    public function generate_certificate()
    {
        // Get all students with RESULT OUT status who don't have certificates yet
        $students = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
            ->leftJoin('student_certificates', function($join) {
                $join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
                     ->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id');
            })
            ->where('student_login.sl_status', 'RESULT OUT')
            ->whereNull('student_certificates.sc_id') // Only show students who don't have a certificate yet
            ->select(
                'student_login.sl_id',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_full_name',
                'course.c_short_name',
                'set_result.sr_id as result_id',
                'set_result.sr_total_marks_obtained',
                'set_result.sr_percentage',
                'set_result.sr_grade',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        return view('admin.certificate.generate', compact('students'));
    }

    // Generate certificate for a student (admin panel)
    public function generate_certificate_now(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'result_id' => 'required|integer',
            'issue_date' => 'required|date',
        ]);

        $studentId = $request->input('student_id');
        $resultId = $request->input('result_id');
        $issueDate = $request->input('issue_date');

        // Get student to find center_id
        $student = Student::findOrFail($studentId);

        // Check if certificate already exists
        $existingCertificate = Certificate::where('sc_FK_of_student_id', $studentId)
            ->where('sc_FK_of_result_id', $resultId)
            ->first();

        if ($existingCertificate) {
            return back()->with('error', 'Certificate already generated for this student!');
        }

        // Generate certificate number (similar to center's logic)
        $certificateNumber = 'CERT-' . date('Y') . '-' . str_pad($studentId, 6, '0', STR_PAD_LEFT) . '-' . time();

        // Create certificate
        $certificate = Certificate::create([
            'sc_FK_of_student_id' => $studentId,
            'sc_FK_of_center_id' => $student->sl_FK_of_center_id,
            'sc_FK_of_result_id' => $resultId,
            'sc_certificate_number' => $certificateNumber,
            'sc_issue_date' => $issueDate,
            'sc_status' => 'GENERATED'
        ]);

        if ($certificate) {
            return redirect()->route('admin.certificate_list')->with('success', 'Certificate generated successfully!');
        } else {
            return back()->with('error', 'Failed to generate certificate!');
        }
    }

    // View certificate (admin panel)
    public function view_certificate($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->select(
                'student_certificates.*',
                'student_login.*',
                'set_result.*',
                'course.*',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        $setting = DB::table('site_settings')->first();
        return view('center.certificate.view', compact('certificate', 'setting'));
    }

    // Delete certificate (admin panel)
    public function delete_certificate($id)
    {
        try {
            $certificate = Certificate::find($id);
            
            if (!$certificate) {
                return back()->with('error', 'Certificate not found!');
            }
            
            // Delete the certificate
            $delete = Certificate::where('sc_id', $id)->delete();
            
            if($delete):
                return back()->with('success', 'Certificate deleted successfully!');
            else:
                return back()->with('error', 'Something Went Wrong!');
            endif;
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting certificate: ' . $e->getMessage());
        }
    }
}

