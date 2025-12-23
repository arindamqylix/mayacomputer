<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CourseSyllabus;
use DB;
use Auth;

class SyllabusController extends Controller
{
    // View syllabus for student's enrolled course
    public function index()
    {
        // Get student's course
        $student = Auth::guard('student')->user();
        $courseId = $student->sl_FK_of_course_id;

        if (!$courseId) {
            return redirect()->route('student_dashboard')->with('error', 'You are not enrolled in any course.');
        }

        // Get course details
        $course = DB::table('course')->where('c_id', $courseId)->first();
        
        // Get syllabus for this course (only active)
        $syllabus = CourseSyllabus::where('cs_FK_of_course_id', $courseId)
            ->where('cs_status', 'active')
            ->orderBy('cs_order')
            ->orderBy('cs_id')
            ->get();

        return view('student.syllabus.index', compact('syllabus', 'course'));
    }
}

