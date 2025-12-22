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
        $student['student'] = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->select(
                'student_login.*',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->get();
        return view('admin.result.create', $student);
    }

    // Store result (admin panel)
    public function set_result_now(Request $request){
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

        // Get student to find center_id
        $student = Student::findOrFail($request->student_id);

        $data = [
            'sr_FK_of_student_id'         => $request->student_id,
            'sr_FK_of_center_id'          => $student->sl_FK_of_center_id,
            'sr_written'                  => $request->written,
            'sr_wr_full_marks'            => $request->wr_full_marks,
            'sr_wr_pass_marks'            => $request->wr_pass_marks,
            'sr_wr_marks_obtained'        => $request->wr_marks_obtained,
            'sr_practical'                => $request->practical,
            'sr_pr_full_marks'            => $request->pr_full_marks,
            'sr_pr_pass_marks'            => $request->pr_pass_marks,
            'sr_pr_marks_obtained'        => $request->pr_marks_obtained,
            'sr_project'                  => $request->project,
            'sr_ap_full_marks'            => $request->ap_full_marks,
            'sr_ap_pass_marks'            => $request->ap_pass_marks,
            'sr_ap_marks_obtained'        => $request->ap_marks_obtained,
            'sr_viva'                     => $request->viva,
            'sr_vv_full_marks'            => $request->vv_full_marks,
            'sr_vv_pass_marks'            => $request->vv_pass_marks,
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
                'center_login.cl_code'
            )
            ->get();

        return view('admin.result.index', $result);
    }
}

