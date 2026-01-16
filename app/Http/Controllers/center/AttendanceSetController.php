<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\AttendanceSet;
use App\Models\center\Attendance;
use Auth;
use DB;

class AttendanceSetController extends Controller
{
    public function index(){
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Get IDs of students already in a batch
        $assignedStudentIds = AttendanceSet::where('as_FK_of_center_id', $centerId)
                                ->pluck('as_FK_of_student_id')
                                ->toArray();

        // Get Verified Students NOT in assigned list
        $students = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->where('student_login.sl_status', 'VERIFIED')
            ->whereNotIn('student_login.sl_id', $assignedStudentIds)
            ->get();

        $batches = Attendance::where('ab_status', 'ACTIVE')->get();
        
        return view('center.attendance.set_attendance', compact('students', 'batches'));
    }

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
