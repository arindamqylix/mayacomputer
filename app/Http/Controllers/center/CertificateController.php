<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Course;
use App\Models\center\Certificate;
use App\Models\center\Result;
use App\Models\center\Student;
use DB;
use Auth;
use Carbon\Carbon;

class CertificateController extends Controller
{
    // List certificates for center (join course on certificate's course so Typing certs show correct course)
    public function certificate_list()
    {
        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
            ->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id')
            ->where('student_certificates.sc_FK_of_center_id', Auth::guard('center')->user()->cl_id)
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                DB::raw('COALESCE(course.c_full_name, course_sl.c_full_name) as c_full_name'),
                DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name')
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
            ->where(function ($q) {
                $q->whereNull('course.is_typing_related')
                    ->orWhere('course.is_typing_related', 0);
            })
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

        $resultStudent = Student::where('sl_id', $studentId)->first();
        if ($resultStudent && Course::isTypingRelated((int) $resultStudent->sl_FK_of_course_id)) {
            return back()->with('error', 'Typing-related courses use typing certificates, not result-based certificates.');
        }

        // Generate certificate number
        $certificateNumber = 'COD' . str_pad($studentId, 5, '0', STR_PAD_LEFT);

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

    // Generate typing certificate page (center): same logic as admin, scoped to this center
    public function generate_typing_certificate()
    {
        $centerId = (int) Auth::guard('center')->user()->cl_id;
        $typingCourseSql = "(c.is_typing_related = 1 OR LOWER(TRIM(COALESCE(c.category_name,''))) = 'typing' OR c.c_short_name LIKE '%Typing%' OR c.c_full_name LIKE '%Typing%')";
        $enrolledSubSql = "
            (SELECT s.sl_id AS sid, c.c_id AS cid
             FROM student_login s
             JOIN course c ON c.c_id = s.sl_FK_of_course_id
             WHERE s.sl_FK_of_center_id = {$centerId}
               AND {$typingCourseSql}
             UNION
             SELECT se.se_FK_of_student_id AS sid, c.c_id AS cid
             FROM student_enrollments se
             JOIN course c ON c.c_id = se.se_FK_of_course_id
             JOIN student_login s ON s.sl_id = se.se_FK_of_student_id
             WHERE se.se_FK_of_center_id = {$centerId}
               AND {$typingCourseSql}
        )";

        $students = DB::table(DB::raw("({$enrolledSubSql}) AS enr"))
            ->join('student_login', 'student_login.sl_id', '=', 'enr.sid')
            ->join('course', 'course.c_id', '=', 'enr.cid')
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
                'student_login.sl_reg_date'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        return view('center.certificate.generate_typing', compact('students'));
    }

    // Store typing certificate (center)
    public function generate_typing_certificate_now(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
            'issue_date' => 'required|date',
            'typing_speed_hindi' => 'required|numeric|min:1',
            'typing_speed_english' => 'required|numeric|min:1',
            'typing_accuracy' => 'required|numeric|min:1|max:100',
        ]);

        $studentId = $request->input('student_id');
        $courseId = $request->input('course_id');
        $centerId = Auth::guard('center')->user()->cl_id;

        $existing = Certificate::where('sc_FK_of_student_id', $studentId)
            ->where('sc_FK_of_course_id', $courseId)
            ->where('sc_type', 'TYPING')
            ->first();
        if ($existing) {
            return back()->with('error', 'Typing certificate already generated for this student and course!');
        }

        $student = Student::findOrFail($studentId);
        if ((int) $student->sl_FK_of_center_id !== (int) $centerId) {
            return back()->with('error', 'Student does not belong to your center.');
        }

        if (! Course::qualifiesForTypingCertificateById((int) $courseId)) {
            return back()->with('error', 'Selected course is not eligible for a typing certificate.');
        }

        $certificateNumber = 'TYP' . str_pad($studentId, 5, '0', STR_PAD_LEFT) . rand(10, 99);
        $h = (string) $request->input('typing_speed_hindi');
        $e = (string) $request->input('typing_speed_english');
        $speedSummary = 'Hindi: ' . $h . ' WPM, English: ' . $e . ' WPM';
        $certificate = Certificate::create([
            'sc_FK_of_student_id' => $studentId,
            'sc_FK_of_center_id' => $centerId,
            'sc_FK_of_course_id' => $courseId,
            'sc_FK_of_result_id' => null,
            'sc_certificate_number' => $certificateNumber,
            'sc_issue_date' => $request->input('issue_date'),
            'sc_type' => 'TYPING',
            'sc_typing_speed' => $speedSummary,
            'sc_typing_speed_hindi' => $h,
            'sc_typing_speed_english' => $e,
            'sc_typing_accuracy' => $request->input('typing_accuracy'),
            'sc_status' => 'GENERATED',
        ]);

        if ($certificate) {
            return redirect()->route('center.typing_certificate_generate')->with('success', 'Typing certificate generated successfully!');
        }
        return back()->with('error', 'Failed to generate certificate!');
    }
}

