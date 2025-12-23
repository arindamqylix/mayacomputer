<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\CourseSyllabus;
use DB;
use Auth;

class SyllabusController extends Controller
{
    // View all courses and their syllabus
    public function index()
    {
        // Get all courses
        $courses = DB::table('course')->get();
        
        // Get syllabus grouped by course
        $syllabusByCourse = [];
        foreach ($courses as $course) {
            $syllabus = CourseSyllabus::where('cs_FK_of_course_id', $course->c_id)
                ->where('cs_status', 'active')
                ->orderBy('cs_order')
                ->orderBy('cs_id')
                ->get();
            
            if ($syllabus->count() > 0) {
                $syllabusByCourse[] = [
                    'course' => $course,
                    'syllabus' => $syllabus
                ];
            }
        }

        return view('center.syllabus.index', compact('syllabusByCourse', 'courses'));
    }

    // View syllabus for a specific course
    public function viewCourse($courseId)
    {
        $course = DB::table('course')->where('c_id', $courseId)->first();
        
        if (!$course) {
            return redirect()->route('center.syllabus.index')->with('error', 'Course not found.');
        }

        $syllabus = CourseSyllabus::where('cs_FK_of_course_id', $courseId)
            ->where('cs_status', 'active')
            ->orderBy('cs_order')
            ->orderBy('cs_id')
            ->get();

        return view('center.syllabus.view', compact('syllabus', 'course'));
    }
}

