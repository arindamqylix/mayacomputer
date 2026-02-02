<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Certificate;
use App\Models\center\Result;
use App\Models\center\Student;
use DB;
use Auth;
use Carbon\Carbon;

class CertificateController extends Controller
{
    // List certificates for center
    public function certificate_list()
    {
        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_certificates.sc_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_certificates.sc_id', 'DESC')
            ->get();

        return view('center.certificate.index', compact('certificates'));
    }

    // List students with results (for generating certificates)
    public function generate_certificate()
    {
        $students = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->leftJoin('student_certificates', function ($join) {
                $join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
                    ->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id');
            })
            ->where('set_result.sr_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->where('student_login.sl_status', 'RESULT OUT')
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
                'student_certificates.sc_id as certificate_id',
                'student_certificates.sc_status',
                'student_login.sl_reg_date',
                'course.c_duration'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        return view('center.certificate.generate', compact('students'));
    }

    // Generate certificate for a student
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

        // Check if certificate already exists
        $existingCertificate = Certificate::where('sc_FK_of_student_id', $studentId)
            ->where('sc_FK_of_result_id', $resultId)
            ->first();

        if ($existingCertificate) {
            return back()->with('error', 'Certificate already generated for this student!');
        }

        // Generate certificate number
        $certificateNumber = 'CERT-' . date('Y') . '-' . str_pad($studentId, 6, '0', STR_PAD_LEFT) . '-' . time();

        // Create certificate
        $certificate = Certificate::create([
            'sc_FK_of_student_id' => $studentId,
            'sc_FK_of_center_id' => Auth::guard('center')->user()->cl_id,
            'sc_FK_of_result_id' => $resultId,
            'sc_certificate_number' => $certificateNumber,
            'sc_issue_date' => $issueDate,
            'sc_status' => 'GENERATED'
        ]);

        if ($certificate) {
            return back()->with('success', 'Certificate generated successfully!');
        } else {
            return back()->with('error', 'Failed to generate certificate!');
        }
    }

    // View certificate (for center panel)
    public function view_certificate($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->where('student_certificates.sc_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->select(
                'student_certificates.*',
                'student_login.*',
                'set_result.*',
                'course.*',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address',
                'center_login.cl_authorized_signature',
                'center_login.cl_center_stamp'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('center.certificate_list')->with('error', 'Certificate not found!');
        }

        $setting = DB::table('site_settings')->first();
        return view('center.certificate.view', compact('certificate', 'setting'));
    }
}

