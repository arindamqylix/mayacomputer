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
    	$batch_id = $request->batch_id;
    	
    	if (!$student_id || !$batch_id) {
    		return response()->json(['status' => 0, 'msg' => 'Please select students and batch']);
    	}

    	$count = 0;
    	
    	try {
	    	foreach($student_id as $data){
	    		$data = trim($data); // Ensure no whitespace
	    		
	    		// Check for duplicate to avoid errors
	    		$exists = AttendanceSet::where('as_FK_of_student_id', $data)
	    					->where('as_FK_of_attendance_batch_id', $batch_id)
	    					->exists();
	    					
	    		if (!$exists) {
		    		AttendanceSet::create([
		    			'as_FK_of_student_id'			=> $data,
		    			'as_FK_of_attendance_batch_id'	=> $batch_id,
		    			'as_FK_of_center_id'			=> Auth::guard('center')->user()->cl_id
		    		]);
		    		$count++;
	    		}
	    	}
	    	
	    	if ($count > 0) {
	    		return response()->json(['status' => 1, 'msg' => $count . ' Students added to attendance successfully']);
	    	} else {
	    		return response()->json(['status' => 1, 'msg' => 'Selected students are already in this batch']);
	    	}
	    	
    	} catch (\Exception $e) {
    		return response()->json(['status' => 0, 'msg' => 'Error: ' . $e->getMessage()]);
    	}
    }
}
