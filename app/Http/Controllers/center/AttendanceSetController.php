<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\AttendanceSet;
use Auth;
class AttendanceSetController extends Controller
{
    public function attendance_set(Request $request){
    	$student_id = $request->student_id;
    	// dd($request->batch_id);
    	// Array to store IDs to insert

    	foreach($student_id as $data){
    		$insert = AttendanceSet::create([
    			'as_FK_of_student_id'			=> $data,
    			'as_FK_of_attendance_batch_id'	=> $request->batch_id,
    			'as_FK_of_center_id'			=> Auth::guard('center')->user()->cl_id
    		]);
    	}
    }
}
