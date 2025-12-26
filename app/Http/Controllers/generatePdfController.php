<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use DB;
use Auth;
class generatePdfController extends Controller
{
    public function generate_result($id)
    {
        $data = DB::table('set_result')
    				->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
    				->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    				->join('center_login', 'set_result.sr_FK_of_center_id', 'center_login.cl_id')
    				->leftJoin('student_certificates', function($join) {
    					$join->on('student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
    					     ->on('student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id');
    				})
    				->where('set_result.sr_id', $id)
    				->select(
    					'set_result.*',
    					'student_login.*',
    					'course.*',
    					'center_login.cl_name',
    					'center_login.cl_center_name',
    					'center_login.cl_code',
    					'center_login.cl_center_address',
    					'student_certificates.sc_issue_date'
    				)
    				->first();

        // Use new diploma marksheet template
        return view('marksheet_diploma', compact('data'));
    }
}
