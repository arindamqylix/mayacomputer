<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CmsCourseController extends Controller
{
    public function index() {
        $courses = DB::table('cms_course')->get();
        return view('admin.cms.course.index', compact('courses'));
    }

    public function create() {
        return view('admin.cms.course.create');
    }

    public function store(Request $request) {
        $path = null;
        if ($request->hasFile('course_image')) {
            $path = $request->file('course_image')->store('courses', 'public');
        }

        DB::table('cms_course')->insert([
            'course_name'     => $request->course_name,
            'course_image'    => $path,
            'course_duration' => $request->course_duration,
            'course_details'  => $request->course_details,
            'created_at'      => now(),
            'updated_at'      => now(),
        ]);

        return redirect()->route('course.list')->with('success', 'Course added successfully!');
    }

    public function edit($id) {
        $course = DB::table('cms_course')->where('id', $id)->first();
        return view('admin.cms.course.edit', compact('course'));
    }

    public function update(Request $request, $id) {
        $path = null;

        if ($request->hasFile('course_image')) {
            $path = $request->file('course_image')->store('courses', 'public');
        }

        DB::table('cms_course')->where('id', $id)->update([
            'course_name'     => $request->course_name,
            'course_image'    => $path ?? DB::table('cms_course')->where('id', $id)->value('course_image'),
            'course_duration' => $request->course_duration,
            'course_details'  => $request->course_details,
            'updated_at'      => now(),
        ]);

        return redirect()->route('course.list')->with('success', 'Course updated successfully!');
    }

    public function destroy($id) {
        DB::table('cms_course')->where('id', $id)->delete();
        return redirect()->route('course.list')->with('success', 'Course deleted successfully!');
    }
}
