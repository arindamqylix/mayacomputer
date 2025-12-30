<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Result;
use App\Models\center\Student;
use DB;
use Auth;

class ResultController extends Controller
{
    // Show result creation form for admin
    public function set_result(){
        // Fetch only VERIFIED students who don't have results published yet
        $student['student'] = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->leftJoin('set_result', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->where('student_login.sl_status', 'VERIFIED') // Only verified/approved students
            ->whereNull('set_result.sr_id') // Exclude students who already have results
            ->select(
                'student_login.*',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();
        return view('admin.result.create', $student);
    }

    // Store result (admin panel)
    public function set_result_now(Request $request){
        // Fixed values: Full Marks = 100, Pass Marks = 40 for each subject
        $total_full_marks = 100 + 100 + 100 + 100; // 400 total
        $total_pass_marks = 40 + 40 + 40 + 40; // 160 total
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

        // Get student to find center_id
        $student = Student::findOrFail($request->student_id);

        $data = [
            'sr_FK_of_student_id'         => $request->student_id,
            'sr_FK_of_center_id'          => $student->sl_FK_of_center_id,
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
            Student::where('sl_id', $request->student_id)->update(['sl_status' => 'RESULT OUT']);
            return redirect()->route('admin.result_list')->with('success', 'Result Set Successfully!');
        else:
            return back()->with('error', 'Something Went Wrong!');
        endif;
    }

    // List all results (admin panel)
    public function result_list()
    {
        $result['result'] = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->select(
                'set_result.*',
                'student_login.sl_name',
                'student_login.sl_id',
                'student_login.sl_email',
                'student_login.sl_reg_no',
                'student_login.sl_father_name',
                'student_login.sl_mother_name',
                'student_login.sl_dob',
                'student_login.sl_sex',
                'student_login.sl_photo',
                'center_login.cl_name as center_name',
                'center_login.cl_center_name',
                'center_login.cl_code as center_code',
                'center_login.cl_code',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('set_result.sr_id', 'DESC')
            ->get();

        return view('admin.result.index', $result);
    }
    
    // Edit result (admin panel)
    public function edit_result($id)
    {
        $result_data = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('set_result.sr_id', $id)
            ->select(
                'set_result.*',
                'student_login.*',
                'center_login.cl_center_name',
                'center_login.cl_code',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->first();
        
        if (!$result_data) {
            return redirect()->route('admin.result_list')->with('error', 'Result not found!');
        }
        
        return view('admin.result.edit', compact('result_data'));
    }
    
    // Update result (admin panel)
    public function update_result(Request $request, $id)
    {
        // Fixed values: Full Marks = 100, Pass Marks = 40 for each subject
        $total_full_marks = 100 + 100 + 100 + 100; // 400 total
        $total_pass_marks = 40 + 40 + 40 + 40; // 160 total
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

        // Get result to find student_id and center_id
        $resultRecord = Result::findOrFail($id);

        $data = [
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

        $update = Result::where('sr_id', $id)->update($data);

        if($update):
            return redirect()->route('admin.result_list')->with('success', 'Result Updated Successfully!');
        else:
            return back()->with('error', 'Something Went Wrong!');
        endif;
    }
    
    // Delete result (admin panel)
    public function delete_result($id)
    {
        try {
            $result = Result::find($id);
            
            if (!$result) {
                return back()->with('error', 'Result not found!');
            }
            
            // Get student ID before deleting
            $studentId = $result->sr_FK_of_student_id;
            
            // Delete the result
            $delete = Result::where('sr_id', $id)->delete();
            
            if($delete):
                // Update student status back to VERIFIED if result is deleted
                Student::where('sl_id', $studentId)->update(['sl_status' => 'VERIFIED']);
                return back()->with('success', 'Result deleted successfully!');
            else:
                return back()->with('error', 'Something Went Wrong!');
            endif;
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting result: ' . $e->getMessage());
        }
    }
}

