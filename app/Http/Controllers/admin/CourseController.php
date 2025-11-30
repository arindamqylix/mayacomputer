<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Course;

class CourseController extends Controller
{
    public function course_list(){
    	$course['course'] = Course::all();
    	return view('admin.course.index',$course);
    }

    public function add_course(){
    	return view('admin.course.create');
    }

    public function add_course_now(Request $request)
	{
		// Validation
		$request->validate([
			'course_short_name' => 'required|string|max:255',
			'course_full_name'  => 'required|string|max:255',
			'course_price'      => 'required|numeric',
			'course_duration'   => 'required|string|max:100',
			'category_name'     => 'nullable|string|max:255',
			'file'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
			'description'       => 'nullable|string',
			'info_title.*'      => 'nullable|string|max:255',
			'info_value.*'      => 'nullable|string|max:255',
			'syll_name.*'       => 'nullable|string|max:255',
			'syll_desc.*'       => 'nullable|string',
		]);

		// File upload to public/courses
		$filePath = null;
		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$filename = time().'_'.$file->getClientOriginalName();
			$file->move(public_path('courses'), $filename);
			$filePath = 'courses/' . $filename;
		}

		// Prepare repeaters
		$information = [];
		if ($request->info_title && $request->info_value) {
			foreach ($request->info_title as $i => $title) {
				$information[] = [
					'title' => $title,
					'value' => $request->info_value[$i] ?? '',
				];
			}
		}

		$syllabus = [];
		if ($request->syll_name && $request->syll_desc) {
			foreach ($request->syll_name as $i => $name) {
				$syllabus[] = [
					'name' => $name,
					'desc' => $request->syll_desc[$i] ?? '',
				];
			}
		}

		$slug = $request->slug;

		// Insert into DB
		$insert = Course::create([
			'c_short_name'  => $request->course_short_name,
			'c_full_name'   => $request->course_full_name,
			'c_price'       => $request->course_price,
			'c_duration'    => $request->course_duration,
			'category_name' => $request->category_name,
			'file'          => $filePath,
			'description'   => $request->description,
			'information'   => json_encode($information),
			'course_syllabus' => json_encode($syllabus),
			'slug'          => $slug,
		]);

		if($insert){
			return back()->with('success', 'Course Added Successfully!');
		} else {
			return back()->with('error', 'Something Went Wrong!');
		}
	}


    public function edit_course($id){
    	$data = Course::where('c_id',$id)->first();
    	return view('admin.course.edit', compact('data'));
    }

    public function update_course(Request $request, $id)
{
	// dd($request->all());
    // Validation
    $request->validate([
        'course_short_name' => 'required|string|max:255',
        'course_full_name'  => 'required|string|max:255',
        'course_price'      => 'required|numeric',
        'course_duration'   => 'required|string|max:100',
        'category_name'     => 'nullable|string|max:255',
        'file'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'description'       => 'nullable|string',
        'info_title.*'      => 'nullable|string|max:255',
        'info_value.*'      => 'nullable|string|max:255',
        'syll_name.*'       => 'nullable|string|max:255',
        'syll_desc.*'       => 'nullable|string',
    ]);

    // Get existing course
    $course = Course::findOrFail($id);

    // File upload to public/courses (replace old file if new uploaded)
    $filePath = $course->file; // existing file
    if ($request->hasFile('file')) {
        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();
        $file->move(public_path('courses'), $filename);
        $filePath = 'courses/' . $filename;
    }

    // Prepare repeaters
    $information = [];
    if ($request->info_title && $request->info_value) {
        foreach ($request->info_title as $i => $title) {
            $information[] = [
                'title' => $title,
                'value' => $request->info_value[$i] ?? '',
            ];
        }
    }

    $syllabus = [];
    if ($request->syll_name && $request->syll_desc) {
        foreach ($request->syll_name as $i => $name) {
            $syllabus[] = [
                'name' => $name,
                'desc' => $request->syll_desc[$i] ?? '',
            ];
        }
    }

    // Update DB
    $update = $course->update([
        'c_short_name'    => $request->course_short_name,
        'c_full_name'     => $request->course_full_name,
        'c_price'         => $request->course_price,
        'c_duration'      => $request->course_duration,
        'category_name'   => $request->category_name,
        'description'     => $request->description,
        'file'            => $filePath,
        'information'     => json_encode($information),
        'course_syllabus' => json_encode($syllabus),
		'slug'				=> $request->slug
    ]);

    if ($update) {
        return back()->with('success', 'Course Updated Successfully!');
    } else {
        return back()->with('error', 'Something Went Wrong!');
    }
}


    public function delete_course($id){
    	$data = Course::where('c_id',$id)->delete();
    	if($data):
    		return back()->with('success', 'Course Deleted Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }
}
