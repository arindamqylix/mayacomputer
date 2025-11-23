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

		return view('student.view_id_card', compact('data'));
	}
}
