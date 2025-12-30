<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsCourseController extends Controller
{
    public function index() {
        $courses = DB::table('course')
            ->orderBy('c_id', 'DESC')
            ->get();
        return view('admin.cms.course.index', compact('courses'));
    }

    public function create() {
        return view('admin.cms.course.create');
    }

    public function store(Request $request) {
        // Validation
		$request->validate([
			'course_short_name' => 'required|string|max:255',
			'course_full_name'  => 'required|string|max:255',
			'course_price'      => 'required|string|max:255',
			'course_duration'   => 'required|string|max:255',
		]);

		try {
			// Insert into DB - using 'course' table
			$insert = DB::table('course')->insert([
				'c_short_name'     => $request->course_short_name,
				'c_full_name'      => $request->course_full_name,
				'c_price'          => $request->course_price,
				'c_duration'       => $request->course_duration,
				'created_at'       => now(),
				'updated_at'       => now(),
			]);

			if($insert){
				return back()->with('success', 'Course Added Successfully!');
			} else {
				return back()->with('error', 'Something Went Wrong!');
			}
		} catch (\Exception $e) {
			return back()->with('error', 'Error: ' . $e->getMessage());
		}
    }

    public function edit($id) {
        $course = DB::table('course')->where('c_id', $id)->first();
        return view('admin.cms.course.edit', compact('course'));
    }

    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'course_short_name' => 'required|string|max:255',
            'course_full_name'  => 'required|string|max:255',
            'course_price'      => 'required|string|max:255',
            'course_duration'   => 'required|string|max:255',
        ]);

        try {
            $update = DB::table('course')->where('c_id', $id)->update([
                'c_short_name'     => $request->course_short_name,
                'c_full_name'      => $request->course_full_name,
                'c_price'          => $request->course_price,
                'c_duration'       => $request->course_duration,
                'updated_at'       => now(),
            ]);

            if($update){
                return redirect()->route('course.list')->with('success', 'Course updated successfully!');
            } else {
                return back()->with('error', 'Something Went Wrong!');
            }
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function destroy($id) {
        try {
            DB::table('course')->where('c_id', $id)->delete();
            return redirect()->route('course.list')->with('success', 'Course deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }
}
