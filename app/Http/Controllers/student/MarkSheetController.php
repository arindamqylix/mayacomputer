<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
class MarkSheetController extends Controller
{
    public function view_marksheet(){
    	$data = DB::table('set_result')
    				->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
    				->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    				->join('center_login', 'set_result.sr_FK_of_center_id', 'center_login.cl_id')
    				->where('set_result.sr_FK_of_student_id', Auth::guard('student')->user()->sl_id)
    				->select(
    					'set_result.*',
    					'student_login.*',
    					'course.*',
    					'center_login.cl_name',
    					'center_login.cl_center_name',
    					'center_login.cl_code',
    					'center_login.cl_center_address'
    				)
    				->first();

    	if (!$data) {
    		return redirect()->route('student_dashboard')->with('error', 'Result not found. Please contact your center.');
    	}

    	// Use the new diploma marksheet template
    	return view('marksheet_diploma', compact('data'));
    }
}
