<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\SetFee;
use App\Models\admin\Course;
use App\Models\center\Student;
use DB;
use Auth;
class SetFeeController extends Controller
{
    public function set_fee(){
    	$course = Course::all();
  	
    	$student = DB::table('student_login')
    							->join('course', 'student_login.sl_Fk_of_course_id', 'course.c_id')
    							->where('student_login.sl_Fk_of_course_id',request()->get('course_id'))
    							->where('student_login.sl_Fk_of_center_id',Auth::guard('center')->user()->cl_id)
    							->get();

    	return view('center.set_fee.index',['course'=>$course, 'student'=>$student]);
    }

    public function set_fee_amount(Request $request){
    	// dd(Auth::guard('center')->user()->cl_id);
    	$check_exist_student = SetFee::where('sf_FK_of_student_id',$request->student_id)->first();
    	if($check_exist_student):
    		$updateData = [
    			'sf_amount'		=> $request->fees_amount
    		];	
    		SetFee::where('sf_FK_of_student_id',$request->student_id)->update($updateData);
    		$data = [
    			'msg'		=> 'Fee Set Successfully!',
    			'status'	=> 1
    		];
    	else:
    		$insertData = [
    			'sf_FK_of_student_id'		=> $request->student_id,
    			'sf_FK_of_center_id'		=> Auth::guard('center')->user()->cl_id,
    			'sf_amount'					=> $request->fees_amount,
    			'sf_due'					=> $request->fees_amount
    		];
    		SetFee::create($insertData);
    		$data = [
    			'msg'		=> 'Fee Set Successfully!',
    			'status'	=> 1
    		];
    	endif;

    	return response()->json($data);

    }
}
