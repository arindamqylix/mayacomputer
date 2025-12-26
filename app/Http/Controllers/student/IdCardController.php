<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class IdCardController extends Controller
{
	public function view_id_card()
	{
		$data = DB::table('student_login')
			->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
			->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
			->where('student_login.sl_id', Auth::guard('student')->user()->sl_id)
			->first();

		if (!$data) {
			return redirect()->route('student_dashboard')->with('error', 'Student information not found.');
		}

		// Check if student is approved (status should be VERIFIED or higher)
		if ($data->sl_status == 'PENDING' || $data->sl_status == 'BLOCK') {
			return redirect()->route('student_dashboard')->with('error', 'Your registration is pending approval. ID Card will be available after admin approval.');
		}

		return view('student.view_id_card', compact('data'));
	}
}
