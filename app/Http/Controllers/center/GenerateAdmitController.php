<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class GenerateAdmitController extends Controller
{
    public function generate_admit_card(){
        $centerId = Auth::guard('center')->user()->cl_id;

        // Fetch Students + Course + Center (Only students of center)
        $students = DB::table('student_login')
            ->leftJoin('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->select(
                'student_login.*',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();

        // Fetch Course List of this Center
        $courseList = DB::table('course')
            ->join('student_login', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->select('course.c_id', 'course.c_full_name', 'course.c_short_name')
            ->distinct()
            ->get();


        return view('center.admit_card.create', compact('students', 'courseList'));
    }

    public function handle_admit_card(Request $request){
        $request->validate([
            'reg_no'      => 'required',
            'exam_date'   => 'required|date',
            'exam_time'   => 'required',
            'exam_venue'  => 'required|string',
            'exam_notice' => 'nullable|string',
        ]);

        $centerId = Auth::guard('center')->user()->cl_id;

        // Get student details - verify student belongs to this center
        $student = DB::table('student_login')
            ->leftJoin('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->where('student_login.sl_id', $request->reg_no)
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->select(
                'student_login.sl_id',
                'student_login.sl_reg_no',
                'student_login.sl_FK_of_course_id'
            )
            ->first();

        if (!$student) {
            return back()->with('error', 'Invalid student selected');
        }

        // Insert Query
        DB::table('student_admit_cards')->insert([
            'center_id'  => $centerId,
            'student_id' => $student->sl_id,
            'course_id'  => $student->sl_FK_of_course_id,
            'reg_no'     => $student->sl_reg_no,
            'exam_date'  => $request->exam_date,
            'exam_time'  => $request->exam_time,
            'exam_venue' => $request->exam_venue,
            'exam_notice'=> $request->exam_notice,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Admit Card Created Successfully!');
    }

    public function admit_card_list(){
        $center_id = Auth::guard('center')->user()->cl_id;

        $admitCards = DB::table('student_admit_cards AS a')
            ->join('student_login AS s', 's.sl_id', '=', 'a.student_id')
            ->join('course AS c', 'c.c_id', '=', 's.sl_FK_of_course_id')
            ->where('a.center_id', $center_id)
            ->select(
                'a.*',
                's.*',
                'c.c_full_name'
            )
            ->get();

        return view('center.admit_card.index', compact('admitCards'));
    }


    public function edit_admit_card($id)
    {
        $center_id = Auth::guard('center')->user()->cl_id;

        // Fetch Admit Card by ID
        $admit = DB::table('student_admit_cards')
            ->where('ac_id', $id)
            ->first();


        // Fetch all students with course name
        $students = DB::table('student_login')
            ->join('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->where('student_login.sl_FK_of_center_id', $center_id)
            ->select('student_login.*', 'course.c_full_name')
            ->get();

        return view('center.admit_card.edit', compact('admit', 'students'));
    }


    public function update_admit_card(Request $request, $id)
    {
        $request->validate([
            'reg_no' => 'required',
            'exam_date' => 'required|date',
            'exam_time' => 'required',
            'exam_venue' => 'required',
        ]);

        DB::table('student_admit_cards')->where('ac_id', $id)->update([
            'student_id'  => $request->reg_no,
            'exam_date'   => $request->exam_date,
            'exam_time'   => $request->exam_time,
            'exam_venue'  => $request->exam_venue,
            'exam_notice' => $request->exam_notice,
        ]);

        return redirect()->route('admit_card_list')->with('success', 'Admit Card Updated Successfully');
    }

    public function print_admit_card($id)
    {
        $admit = DB::table('student_admit_cards')
            ->where('ac_id', $id)
            ->first();

        if (!$admit) {
            return back()->with('error', 'Admit Card not found');
        }

        $student = DB::table('student_login')
            ->where('sl_id', $admit->student_id)
            ->first();

        $course = DB::table('course')
            ->where('c_id', $student->sl_FK_of_course_id)
            ->first();

        $center = DB::table('center_login')
            ->where('cl_id', $admit->center_id)
            ->first();

        return view('center.admit_card.print', compact('admit', 'student', 'course', 'center'));
    }

}
