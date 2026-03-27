<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\admin\Course;
use App\Models\center\Certificate;
use App\Models\center\Student;
use Carbon\Carbon;

class CertificateController extends Controller
{
    // List all certificates (admin panel)
    // Join course on certificate's course (sc_FK_of_course_id) so Typing certs show correct course
    public function certificate_list()
    {
        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
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
        // Get all students with RESULT OUT status who don't have REGULAR certificates yet
        $students = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
            ->leftJoin('student_certificates', function ($join) {
                $join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
                    ->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
                    ->where('student_certificates.sc_type', 'REGULAR');
            })
            ->where('student_login.sl_status', 'RESULT OUT')
            ->whereNull('student_certificates.sc_id')
            ->where(function ($q) {
                $q->whereNull('course.is_typing_related')
                    ->orWhere('course.is_typing_related', 0);
            })
            ->select(
                'student_login.sl_id',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_id',
                'course.c_full_name',
                'course.c_short_name',
                'course.c_duration',
                'student_login.sl_reg_date',
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

    // Generate typing certificate page (admin panel)
    // Include students enrolled in Typing via sl_FK_of_course_id OR via student_enrollments
    // Typing course: category_name = 'Typing' OR course name contains 'Typing'
    public function generate_typing_certificate()
    {
        $typingCourseSql = "(c.is_typing_related = 1 OR LOWER(TRIM(COALESCE(c.category_name,''))) = 'typing' OR c.c_short_name LIKE '%Typing%' OR c.c_full_name LIKE '%Typing%')";
        $enrolledSubSql = "
            (SELECT s.sl_id AS sid, c.c_id AS cid
             FROM student_login s
             JOIN course c ON c.c_id = s.sl_FK_of_course_id
             WHERE {$typingCourseSql}
             UNION
             SELECT se.se_FK_of_student_id AS sid, c.c_id AS cid
             FROM student_enrollments se
             JOIN course c ON c.c_id = se.se_FK_of_course_id
             JOIN student_login s ON s.sl_id = se.se_FK_of_student_id
             WHERE {$typingCourseSql}
        )";

        $students = DB::table(DB::raw("{$enrolledSubSql} AS enr"))
            ->join('student_login', 'student_login.sl_id', '=', 'enr.sid')
            ->join('course', 'course.c_id', '=', 'enr.cid')
            ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
            ->leftJoin('student_certificates', function ($join) {
                $join->on('student_certificates.sc_FK_of_student_id', '=', 'enr.sid')
                    ->on('student_certificates.sc_FK_of_course_id', '=', 'enr.cid')
                    ->where('student_certificates.sc_type', 'TYPING');
            })
            ->whereNull('student_certificates.sc_id')
            ->select(
                'student_login.sl_id',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_id',
                'course.c_full_name',
                'course.c_short_name',
                'course.c_duration',
                'student_login.sl_reg_date',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        return view('admin.certificate.generate_typing', compact('students'));
    }

    // Generate certificate for a student (admin panel)
    public function generate_certificate_now(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
            'issue_date' => 'required|date',
            'type' => 'required|in:REGULAR,TYPING',
        ]);

        $studentId = $request->input('student_id');
        $courseId = $request->input('course_id');
        $resultId = $request->input('result_id');
        $type = $request->input('type');
        $issueDate = $request->input('issue_date');

        // Check if certificate already exists for this course and type
        $existingCertificateQuery = Certificate::where('sc_FK_of_student_id', $studentId)
            ->where('sc_FK_of_course_id', $courseId)
            ->where('sc_type', $type);

        if ($type == 'REGULAR' && $resultId) {
            $existingCertificateQuery->where('sc_FK_of_result_id', $resultId);
        }

        if ($existingCertificateQuery->first()) {
            return back()->with('error', 'Certificate already generated for this student and course!');
        }

        $student = Student::findOrFail($studentId);

        if ($type === 'TYPING') {
            if (! Course::qualifiesForTypingCertificateById((int) $courseId)) {
                return back()->with('error', 'Selected course is not eligible for a typing certificate. Mark the course as typing-related or use the legacy typing category/name.');
            }
        } elseif (Course::isTypingRelated((int) $courseId)) {
            return back()->with('error', 'Regular certificates are not issued for typing-related courses. Use a typing certificate instead.');
        }

        // Generate certificate number
        $prefix = $type == 'TYPING' ? 'TYP' : 'COD';
        $certificateNumber = $prefix . str_pad($studentId, 5, '0', STR_PAD_LEFT) . rand(10, 99);

        // Create certificate
        $certificate = Certificate::create([
            'sc_FK_of_student_id' => $studentId,
            'sc_FK_of_center_id' => $student->sl_FK_of_center_id,
            'sc_FK_of_course_id' => $courseId,
            'sc_FK_of_result_id' => $resultId,
            'sc_certificate_number' => $certificateNumber,
            'sc_issue_date' => $issueDate,
            'sc_type' => $type,
            'sc_typing_speed' => $request->typing_speed,
            'sc_typing_accuracy' => $request->typing_accuracy,
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
        $certificate_base = DB::table('student_certificates')->where('sc_id', $id)->first();
        if (!$certificate_base) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        $query = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id);

        if ($certificate_base->sc_type == 'REGULAR') {
            $query->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
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
                );
        } else {
            $query->select(
                'student_certificates.*',
                'student_login.*',
                'course.*',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address',
                'center_login.cl_authorized_signature',
                'center_login.cl_center_stamp'
            );
        }

        $certificate = $query->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate data missing!');
        }

        $setting = DB::table('site_settings')->first();

        if ($certificate->sc_type == 'TYPING') {
            return view('center.certificate.typing_view', compact('certificate', 'setting'));
        }

        return view('center.certificate.view', compact('certificate', 'setting'));
    }

    // Edit certificate (admin panel)
    public function edit_certificate($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'course.c_full_name',
                'center_login.cl_center_name'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        return view('admin.certificate.edit', compact('certificate'));
    }

    // Update certificate (admin panel)
    public function update_certificate(Request $request, $id)
    {
        $request->validate([
            'certificate_number' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'status' => 'required|string|in:GENERATED,ISSUED',
        ]);

        $certificate = Certificate::find($id);

        if (!$certificate) {
            return back()->with('error', 'Certificate not found!');
        }

        $certificate->update([
            'sc_certificate_number' => $request->certificate_number,
            'sc_issue_date' => $request->issue_date,
            'sc_status' => $request->status,
        ]);

        return redirect()->route('admin.certificate_list')->with('success', 'Certificate updated successfully!');
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

            if ($delete):
                return back()->with('success', 'Certificate deleted successfully!');
            else:
                return back()->with('error', 'Something Went Wrong!');
            endif;
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting certificate: ' . $e->getMessage());
        }
    }
}

