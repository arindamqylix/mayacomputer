<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class MarkSheetController extends Controller
{
	public function result_list()
	{
		$user = Auth::guard('student')->user();
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		$results = DB::table('set_result')
			->join('course', 'set_result.sr_FK_of_course_id', '=', 'course.c_id')
			->whereIn('set_result.sr_FK_of_student_id', $slIds)
			->where(function ($q) {
				$q->whereNull('course.is_typing_related')
					->orWhere('course.is_typing_related', 0);
			})
			->select(
				'set_result.sr_id',
				'set_result.sr_total_marks_obtained',
				'set_result.sr_total_full_marks',
				'set_result.sr_percentage',
				'set_result.sr_grade',
				'course.c_short_name',
				'course.c_full_name'
			)
			->orderBy('set_result.sr_id', 'DESC')
			->get();

		return view('student.result.list', compact('results'));
	}

	public function view_marksheet($id = null)
	{
		$user = Auth::guard('student')->user();
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		if ($id === null) {
			return $this->result_list();
		}

		$data = DB::table('set_result')
			->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
			->join('course', 'set_result.sr_FK_of_course_id', 'course.c_id')
			->join('center_login', 'set_result.sr_FK_of_center_id', 'center_login.cl_id')
			->leftJoin('student_certificates', function ($join) {
				$join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
					->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id');
			})
			->where('set_result.sr_id', (int) $id)
			->whereIn('set_result.sr_FK_of_student_id', $slIds)
			->where(function ($q) {
				$q->whereNull('course.is_typing_related')
					->orWhere('course.is_typing_related', 0);
			})
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
			return redirect()->route('view_marksheet')->with('error', 'Result not found. Please contact your center.');
		}

		$setting = DB::table('site_settings')->first();

		return view('marksheet_diploma', compact('data', 'setting'));
	}

	// Regular course certificates (student panel)
	public function view_certificate()
	{
		$user = Auth::guard('student')->user();
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		$certificates = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
			->leftJoin('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
			->whereIn('student_certificates.sc_FK_of_student_id', $slIds)
			->where(function ($q) {
				$q->where('student_certificates.sc_type', 'REGULAR')
					->orWhere(function ($q2) {
						$q2->whereNull('student_certificates.sc_type')
							->whereNotNull('student_certificates.sc_FK_of_result_id');
					});
			})
			->select(
				'student_certificates.sc_id',
				'student_certificates.sc_certificate_number',
				'student_certificates.sc_issue_date',
				'course.c_short_name',
				'course.c_full_name',
				'set_result.sr_percentage',
				'set_result.sr_grade'
			)
			->orderBy('student_certificates.sc_id', 'DESC')
			->get();

		return view('student.certificate.regular_list', compact('certificates'));
	}

	public function view_regular_certificate($id)
	{
		$user = Auth::guard('student')->user();
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		$certificateBase = DB::table('student_certificates')
			->where('sc_id', $id)
			->whereIn('sc_FK_of_student_id', $slIds)
			->where(function ($q) {
				$q->where('sc_type', 'REGULAR')
					->orWhere(function ($q2) {
						$q2->whereNull('sc_type')
							->whereNotNull('sc_FK_of_result_id');
					});
			})
			->first();

		if (!$certificateBase) {
			return redirect()->route('student.view_certificate')->with('error', 'Certificate not found.');
		}

		$certificate = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
			->leftJoin('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
			->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
			->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id')
			->where('student_certificates.sc_id', $id)
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
			)
			->first();

		if (!$certificate) {
			return redirect()->route('student.view_certificate')->with('error', 'Certificate not found.');
		}

		$setting = DB::table('site_settings')->first();

		return view('center.certificate.view', compact('certificate', 'setting'));
	}

	/** List typing certificates for this student (no result publication required). */
	public function typing_certificate_list()
	{
		$user = Auth::guard('student')->user();
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		$certificates = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
			->whereIn('student_certificates.sc_FK_of_student_id', $slIds)
			->where('student_certificates.sc_type', 'TYPING')
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
				$course = DB::table('student_certificates as sc')
					->join('course', 'sc.sc_FK_of_course_id', '=', 'course.c_id')
					->where('sc.sc_id', $cert->sc_id)
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
		$slIds = student_sl_ids_for_person((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);
		if ($slIds === []) {
			$slIds = [(int) $user->sl_id];
		}

		$certificateBase = DB::table('student_certificates')
			->where('sc_id', $id)
			->whereIn('sc_FK_of_student_id', $slIds)
			->where('sc_type', 'TYPING')
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
