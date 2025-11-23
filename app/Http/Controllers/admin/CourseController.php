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

    public function add_course_now(Request $request){
    	$data = [
    		'c_short_name'			=> $request->course_short_name,
    		'c_full_name'			=> $request->course_full_name,
    		'c_price'				=> $request->course_price,
    		'c_duration'			=> $request->course_duration,
    	];
    	$insert = Course::create($data);
    	if($insert):
    		return back()->with('success', 'Course Added Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    public function edit_course($id){
    	$data = Course::where('c_id',$id)->first();
    	return view('admin.course.edit', compact('data'));
    }

    public function update_course(Request $request,$id){
    	$data = [
    		'c_short_name'			=> $request->course_short_name,
    		'c_full_name'			=> $request->course_full_name,
    		'c_price'				=> $request->course_price,
    		'c_duration'			=> $request->course_duration,
    	];
    	$insert = Course::where('c_id',$id)->update($data);
    	if($insert):
    		return back()->with('success', 'Course Updated Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
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
