<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class MarkSheetController extends Controller
{
	public function view_marksheet()
	{
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
				'student_certificates.sc_issue_date'
			)
			->first();

		if (!$data) {
			return redirect()->route('student_dashboard')->with('error', 'Result not found. Please contact your center.');
		}

		// Use the new diploma marksheet template
		$setting = DB::table('site_settings')->first();
		return view('marksheet_diploma', compact('data', 'setting'));
	}

	// View certificate (student panel)
	public function view_certificate()
	{
		$certificate = DB::table('student_certificates')
			->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
			->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
			->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
			->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
			->where('student_certificates.sc_FK_of_student_id', Auth::guard('student')->user()->sl_id)
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
			->orderBy('student_certificates.sc_id', 'DESC')
			->first();

		if (!$certificate) {
			return redirect()->route('student_dashboard')->with('error', 'Certificate not found. Please contact your center.');
		}

		$setting = DB::table('site_settings')->first();
		return view('center.certificate.view', compact('certificate', 'setting'));
	}
}
