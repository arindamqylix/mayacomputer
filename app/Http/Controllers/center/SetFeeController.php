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
    	$centerId = Auth::guard('center')->user()->cl_id;
  	
    	$student = DB::table('student_login')
    							->join('course', 'student_login.sl_Fk_of_course_id', 'course.c_id')
    							->leftJoin('set_fee', function($join) use ($centerId) {
    								$join->on('set_fee.sf_FK_of_student_id', '=', 'student_login.sl_id')
    									 ->where('set_fee.sf_FK_of_center_id', $centerId);
    							})
    							->where('student_login.sl_Fk_of_course_id',request()->get('course_id'))
    							->where('student_login.sl_Fk_of_center_id', $centerId)
    							->select(
    								'student_login.*',
    								'course.c_price',
    								'course.c_short_name',
    								'course.c_full_name',
    								'set_fee.sf_amount as existing_fee',
    								'set_fee.sf_paid',
    								'set_fee.sf_due'
    							)
    							->get();

    	return view('center.set_fee.index',['course'=>$course, 'student'=>$student]);
    }

    public function set_fee_amount(Request $request){
    	$centerId = Auth::guard('center')->user()->cl_id;
    	$feeAmount = floatval($request->fees_amount);
    	
    	// Validate fee amount
    	if ($feeAmount < 0) {
    		return response()->json([
    			'msg' => 'Fee amount cannot be negative',
    			'status' => 0
    		]);
    	}
    	
    	$check_exist_student = SetFee::where('sf_FK_of_student_id', $request->student_id)
    								  ->where('sf_FK_of_center_id', $centerId)
    								  ->first();
    	
    	if($check_exist_student):
    		// If fee already exists, update the amount and recalculate due
    		$existingPaid = floatval($check_exist_student->sf_paid ?? 0);
    		$newDue = $feeAmount - $existingPaid;
    		
    		$updateData = [
    			'sf_amount' => $feeAmount,
    			'sf_due' => max(0, $newDue) // Due cannot be negative
    		];
    		
    		SetFee::where('sf_FK_of_student_id', $request->student_id)
    			  ->where('sf_FK_of_center_id', $centerId)
    			  ->update($updateData);
    		
    		$data = [
    			'msg' => 'Fee Updated Successfully!',
    			'status' => 1
    		];
    	else:
    		// New fee entry
    		$insertData = [
    			'sf_FK_of_student_id' => $request->student_id,
    			'sf_FK_of_center_id' => $centerId,
    			'sf_amount' => $feeAmount,
    			'sf_paid' => 0,
    			'sf_due' => $feeAmount
    		];
    		SetFee::create($insertData);
    		$data = [
    			'msg' => 'Fee Set Successfully!',
    			'status' => 1
    		];
    	endif;

    	return response()->json($data);
    }
}
