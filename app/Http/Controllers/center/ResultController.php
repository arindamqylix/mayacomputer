<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Result;
use App\Models\center\Student;
use DB;
use Auth;
class ResultController extends Controller
{
    public function set_result(){
    	$centerId = Auth::guard('center')->user()->cl_id;
    	
    	// Fetch only VERIFIED students who don't have results published yet
    	$student['student'] = DB::table('student_login')
    						 ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    						 ->leftJoin('set_result', function($join) use ($centerId) {
    						 	$join->on('set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
    						 		 ->where('set_result.sr_FK_of_center_id', $centerId);
    						 })
    						 ->where('student_login.sl_FK_of_center_id', $centerId)
    						 ->where('student_login.sl_status', 'VERIFIED') // Only VERIFIED students - exclude PENDING, BLOCKED, etc.
    						 ->whereNull('set_result.sr_id') // Exclude students who already have results published
    						 ->select(
    						 	'student_login.*',
    						 	'course.c_full_name',
    						 	'course.c_short_name'
    						 )
    						 ->orderBy('student_login.sl_id', 'DESC')
    						 ->get();
    	return view('center.result.create',$student);
    }

    public function set_result_now(Request $request){
        $request->validate([
            'wr_marks_obtained' => 'required|numeric|min:1|max:85',
            'pr_marks_obtained' => 'required|numeric|min:1|max:85',
            'ap_marks_obtained' => 'required|numeric|min:1|max:85',
            'vv_marks_obtained' => 'required|numeric|min:1|max:85',
        ]);

        // Fixed values: Full Marks = 100, Pass Marks = 40 for each subject
        $total_full_marks = 100 + 100 + 100 + 100; // 400 total
        $total_pass_marks = 40 + 40 + 40 + 40; // 160 total

        $total_marks_obtained = $request->wr_marks_obtained + $request->pr_marks_obtained + $request->ap_marks_obtained + $request->vv_marks_obtained;

        // Total marks for each subject (each subject has 100 marks)
        $totalPossibleMarks = 100 * 4; // 4 subjects, each with 100 marks

        // Calculate percentage
        $percentage = ($total_marks_obtained / $totalPossibleMarks) * 100;

        // Define grade boundaries and corresponding grades
        $gradeBoundaries = array(
            'A+' => 90,
            'A' => 80,
            'B' => 70,
            'C' => 60,
            'D' => 50,
            'F' => 0
        );

        // Calculate grade
        $grade = 'F'; // Default grade
        foreach ($gradeBoundaries as $gradeSymbol => $boundary) {
            if ($percentage >= $boundary) {
                $grade = $gradeSymbol;
                break;
            }
        }

    	$data = [
            'sr_FK_of_student_id'         => $request->student_id,
            'sr_FK_of_center_id'          => Auth::guard('center')->user()->cl_id,
            'sr_written'                  => $request->written,
            'sr_wr_full_marks'            => 100,
            'sr_wr_pass_marks'            => 40,
            'sr_wr_marks_obtained'        => $request->wr_marks_obtained,
            'sr_practical'                => $request->practical,
            'sr_pr_full_marks'            => 100,
            'sr_pr_pass_marks'            => 40,
            'sr_pr_marks_obtained'        => $request->pr_marks_obtained,
            'sr_project'                  => $request->project,
            'sr_ap_full_marks'            => 100,
            'sr_ap_pass_marks'            => 40,
            'sr_ap_marks_obtained'        => $request->ap_marks_obtained,
            'sr_viva'                     => $request->viva,
            'sr_vv_full_marks'            => 100,
            'sr_vv_pass_marks'            => 40,
            'sr_vv_marks_obtained'        => $request->vv_marks_obtained,
            'sr_total_full_marks'         => $total_full_marks,
            'sr_total_pass_marks'         => $total_pass_marks,
            'sr_total_marks_obtained'     => $total_marks_obtained,
            'sr_percentage'               => $percentage,
            'sr_grade'                    => $grade,
        ];

        $insert = Result::create($data);
        

        if($insert):
            // Update student status to RESULT OUT (removes from RESULT UPDATED list)
            Student::where('sl_id',$request->student_id)->update(['sl_status'=> 'RESULT OUT']);
            return back()->with('success', 'Result Set Successfully!');
        else:
            return back()->with('error', 'Something Went Wrong!');
        endif;
    } 

    public function edit_result($id){
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Check if result already exists - if yes, disable editing
        $result = Result::where('sr_FK_of_student_id', $id)
                        ->where('sr_FK_of_center_id', $centerId)
                        ->first();
        
        if ($result) {
            // Result already generated, editing is disabled for centers
            return redirect()->route('student_result_list')
                            ->with('error', 'Result has already been generated. Editing is disabled. Please contact admin for any changes.');
        }
        
        $student['student'] = DB::table('student_login')
                             ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
                             ->where('student_login.sl_status', 'VERIFIED')
                             ->where('student_login.sl_FK_of_center_id', $centerId)
                             ->get();
        $student_data = Student::where('sl_id',$id)->first();
        
        if (!$student_data) {
            return redirect()->route('student_result_list')
                            ->with('error', 'Student not found.');
        }
        
        return view('center.result.edit', $student, compact('student_data','result'));
    } 

    public function update_result(Request $request,$id){
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Check if result already exists - if yes, prevent update
        $existingResult = Result::where('sr_FK_of_student_id', $id)
                                ->where('sr_FK_of_center_id', $centerId)
                                ->first();
        
        if ($existingResult) {
            // Result already generated, updating is disabled for centers
            return redirect()->route('student_result_list')
                            ->with('error', 'Result has already been generated. Updating is disabled. Please contact admin for any changes.');
        }
        
        $total_full_marks = $request->wr_full_marks + $request->pr_full_marks + $request->ap_full_marks + $request->vv_full_marks;

        $total_pass_marks = $request->wr_pass_marks + $request->pr_pass_marks + $request->ap_pass_marks + $request->vv_pass_marks;


        $total_marks_obtained = $request->wr_marks_obtained + $request->pr_marks_obtained + $request->ap_marks_obtained + $request->vv_marks_obtained;

        // Total marks for each subject (assuming each subject has a maximum of 100 marks)
        $totalPossibleMarks = 100 * 4; // 4 subjects, each with 100 marks

        // Calculate percentage
        $percentage = ($total_marks_obtained / $totalPossibleMarks) * 100;

        // Define grade boundaries and corresponding grades
        $gradeBoundaries = array(
            'A+' => 90,
            'A' => 80,
            'B' => 70,
            'C' => 60,
            'D' => 50,
            'F' => 0
        );

        // Calculate grade
        $grade = 'F'; // Default grade
        foreach ($gradeBoundaries as $gradeSymbol => $boundary) {
            if ($percentage >= $boundary) {
                $grade = $gradeSymbol;
                break;
            }
        }

        $data = [
            'sr_FK_of_student_id'         => $request->student_id,
            'sr_FK_of_center_id'          => Auth::guard('center')->user()->cl_id,
            'sr_written'                  => $request->written,
            'sr_wr_full_marks'            => 100,
            'sr_wr_pass_marks'            => 40,
            'sr_wr_marks_obtained'        => $request->wr_marks_obtained,
            'sr_practical'                => $request->practical,
            'sr_pr_full_marks'            => 100,
            'sr_pr_pass_marks'            => 40,
            'sr_pr_marks_obtained'        => $request->pr_marks_obtained,
            'sr_project'                  => $request->project,
            'sr_ap_full_marks'            => 100,
            'sr_ap_pass_marks'            => 40,
            'sr_ap_marks_obtained'        => $request->ap_marks_obtained,
            'sr_viva'                     => $request->viva,
            'sr_vv_full_marks'            => 100,
            'sr_vv_pass_marks'            => 40,
            'sr_vv_marks_obtained'        => $request->vv_marks_obtained,
            'sr_total_full_marks'         => $total_full_marks,
            'sr_total_pass_marks'         => $total_pass_marks,
            'sr_total_marks_obtained'     => $total_marks_obtained,
            'sr_percentage'               => $percentage,
            'sr_grade'                    => $grade,
        ];

        $insert = Result::where('sr_FK_of_student_id',$id)->update($data);
        

        if($insert):
            // Update student status to RESULT OUT (removes from RESULT UPDATED list)
            Student::where('sl_id',$request->student_id)->update(['sl_status'=> 'RESULT OUT']);
            return back()->with('success', 'Result Updated Successfully!');
        else:
            return back()->with('error', 'Something Went Wrong!');
        endif;
    } 

    public function student_result_list (){
        $result['result'] = DB::table('set_result')
                  ->join('student_login', 'set_result.sr_FK_of_student_id', 'student_login.sl_id')
                  ->where('set_result.sr_FK_of_center_id', Auth::guard('center')->user()->cl_id)
                  ->get();
        return view('center.result.index',$result);
    }
}
