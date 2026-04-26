<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\admin\Course;
use Illuminate\Http\Request;
use DB;
use Auth;
class MarkSheetController extends Controller
{
	public function view_marksheet()
	{
		$courseId = (int) Auth::guard('student')->user()->sl_FK_of_course_id;
		if ($courseId > 0 && Course::qualifiesForTypingCertificateById($courseId)) {
			return redirect()->route('student_dashboard')->with('error', 'Results are not published for your course type. Use Typing Certificate from the menu when your center issues it.');
		}

		$data = DB::table('set_result')
			->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->join('center_login', 'set_result.sr_FK_of_center_id', 'center_login.cl_id')
			->leftJoin('student_certificates', function ($join) {
				$join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
					->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id');
			})
			->where('set_result.sr_FK_of_student_id', Auth::guard('student')->user()->sl_id)
			->select(
				'set_result.*',
				'student_login.*',
				'course.*',
				'center_login.cl_name',
				'center_login.cl_center_name',
				'center_login.cl_code',
				'center_login.cl_center_address',
				'center_login.cl_authorized_signature',
				'center_login.cl_center_stamp',
				'student_certificates.sc_issue_date',
				'student_certificates.sc_certificate_number'
			)
			->first();

		if (!$data) {
			return redirect()->route('student_dashboard')->with('error', 'Result not found. Please contact your center.');
		}

		// Use the new diploma marksheet template
		$setting = DB::table('site_settings')->first();
		return view('marksheet_diploma', compact('data', 'setting'));
	}

	// View certificate (student panel) – supports both REGULAR and TYPING certificates
	public function view_certificate()
	{
		$studentId = Auth::guard('student')->user()->sl_id;

		// Get latest certificate for this student (any type) – works even if sc_type column missing (old DB)
		$certificateBase = DB::table('student_certificates')
			->where('sc_FK_of_student_id', $studentId)
			->orderBy('sc_id', 'DESC')
			->first();

		if (!$certificateBase) {
			// Show dedicated page instead of redirect with error (avoids red alert on dashboard)
			return view('student.certificate.not_available');
		}

		// Treat as REGULAR (with result) when sc_type is not TYPING and result_id is set (handles old certs with null sc_type)
		$isTyping = isset($certificateBase->sc_type) && $certificateBase->sc_type === 'TYPING';
		$needSetResult = !$isTyping && !empty($certificateBase->sc_FK_of_result_id);

		// Load full data: leftJoin center so missing center_id does not drop row; course from cert or student
		$query = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
			->where('student_certificates.sc_id', $certificateBase->sc_id);

		$query->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id');
		$query->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id');

		if ($needSetResult) {
			$query->leftJoin('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
				->select(
					'student_certificates.*',
					'student_login.*',
					'set_result.sr_id',
					'set_result.sr_total_marks_obtained',
					'set_result.sr_percentage',
					'set_result.sr_grade',
					DB::raw('COALESCE(course.c_full_name, course_sl.c_full_name) as c_full_name'),
					DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name'),
					DB::raw('COALESCE(course.c_duration, course_sl.c_duration) as c_duration'),
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
				DB::raw('COALESCE(course.c_full_name, course_sl.c_full_name) as c_full_name'),
				DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name'),
				DB::raw('COALESCE(course.c_duration, course_sl.c_duration) as c_duration'),
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
			return view('student.certificate.not_available');
		}

		$setting = DB::table('site_settings')->first();

		if ($isTyping) {
			return view('center.certificate.typing_view', compact('certificate', 'setting'));
		}

		return view('center.certificate.view', compact('certificate', 'setting'));
	}

	/** List typing certificates for this student (no result publication required). */
	public function typing_certificate_list()
	{
		$user = Auth::guard('student')->user();
		$studentId = $user->sl_id;
		$regNo = $user->sl_reg_no ?? null;

		// Match by sl_id OR by same registration number (in case cert is linked to another sl_id for same person)
		$certificates = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
			->where(function ($q) use ($studentId, $regNo) {
				$q->where('student_certificates.sc_FK_of_student_id', $studentId);
				if ($regNo) {
					$q->orWhere('student_login.sl_reg_no', $regNo);
				}
			})
			->where(function ($q) {
				$q->where('student_certificates.sc_type', 'TYPING')
					->orWhereRaw('(student_certificates.sc_type IS NULL AND student_certificates.sc_FK_of_result_id IS NULL)')
					->orWhereRaw('(student_certificates.sc_type = \'REGULAR\' AND student_certificates.sc_FK_of_result_id IS NULL)')
					->orWhereNotNull('student_certificates.sc_typing_speed')
					->orWhereNotNull('student_certificates.sc_typing_speed_hindi')
					->orWhereNotNull('student_certificates.sc_typing_speed_english')
					->orWhereNotNull('student_certificates.sc_typing_accuracy')
					->orWhereRaw('(LOWER(TRIM(COALESCE(course.category_name,\'\'))) = \'typing\' OR course.c_short_name LIKE \'%Typing%\' OR course.c_full_name LIKE \'%Typing%\')');
			})
			->select(
				'student_certificates.sc_id',
				'student_certificates.sc_certificate_number',
				'student_certificates.sc_issue_date',
				'student_certificates.sc_typing_speed',
				'student_certificates.sc_typing_speed_hindi',
				'student_certificates.sc_typing_speed_english',
				'student_certificates.sc_typing_accuracy',
				'course.c_short_name',
				'course.c_full_name'
			)
			->orderBy('student_certificates.sc_id', 'DESC')
			->get();

		// If course name missing, get from student's primary course
		foreach ($certificates as $cert) {
			if (empty($cert->c_short_name) && empty($cert->c_full_name)) {
				$course = DB::table('student_login')
					->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
					->where('student_login.sl_id', $studentId)
					->select('course.c_short_name', 'course.c_full_name')
					->first();
				if ($course) {
					$cert->c_short_name = $course->c_short_name;
					$cert->c_full_name = $course->c_full_name;
				}
			}
		}

		return view('student.certificate.typing_list', compact('certificates'));
	}

	/** View a single typing certificate by id (must belong to logged-in student, by sl_id or same reg_no). */
	public function view_typing_certificate($id)
	{
		$user = Auth::guard('student')->user();
		$studentId = $user->sl_id;
		$regNo = $user->sl_reg_no ?? null;

		// Same criteria as list; allow if cert is for this sl_id OR for same reg_no
		$certificateBase = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->where('student_certificates.sc_id', $id)
			->where(function ($q) use ($studentId, $regNo) {
				$q->where('student_certificates.sc_FK_of_student_id', $studentId);
				if ($regNo) {
					$q->orWhere('student_login.sl_reg_no', $regNo);
				}
			})
			->where(function ($q) {
				$q->where('student_certificates.sc_type', 'TYPING')
					->orWhereRaw('(student_certificates.sc_type IS NULL AND student_certificates.sc_FK_of_result_id IS NULL)')
					->orWhereRaw('(student_certificates.sc_type = \'REGULAR\' AND student_certificates.sc_FK_of_result_id IS NULL)')
					->orWhereNotNull('student_certificates.sc_typing_speed')
					->orWhereNotNull('student_certificates.sc_typing_speed_hindi')
					->orWhereNotNull('student_certificates.sc_typing_speed_english')
					->orWhereNotNull('student_certificates.sc_typing_accuracy');
			})
			->select('student_certificates.sc_id')
			->first();

		if (!$certificateBase) {
			return redirect()->route('student.typing_certificate_list')->with('error', 'Certificate not found.');
		}

		$query = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
			->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
			->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id')
			->where('student_certificates.sc_id', $id)
			->select(
				'student_certificates.*',
				'student_login.*',
				DB::raw('COALESCE(course.c_full_name, course_sl.c_full_name) as c_full_name'),
				DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name'),
				DB::raw('COALESCE(course.c_duration, course_sl.c_duration) as c_duration'),
				'center_login.cl_center_name',
				'center_login.cl_name',
				'center_login.cl_code',
				'center_login.cl_center_address',
				'center_login.cl_authorized_signature',
				'center_login.cl_center_stamp'
			);

		$certificate = $query->first();
		if (!$certificate) {
			return redirect()->route('student.typing_certificate_list')->with('error', 'Certificate not found.');
		}

		$setting = DB::table('site_settings')->first();
		return view('center.certificate.typing_view', compact('certificate', 'setting'));
	}
}
