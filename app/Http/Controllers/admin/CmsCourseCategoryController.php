<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsCourseCategoryController extends Controller
{
    // List all course categories
    public function courseCategory() {
        $categories = DB::table('cms_course_category')->orderBy('id', 'desc')->get();
        return view('admin.cms.course_category.index', compact('categories'));
    }

    // Show create form
    public function createCourseCategory() {
        return view('admin.cms.course_category.create');
    }

    // Store new category
    public function storeCourseCategory(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cms_course_category,slug',
            'status' => 'nullable|boolean',
        ]);

        $insert = DB::table('cms_course_category')->insert([
            'name'       => $request->name,
            'slug'       => Str::slug($request->slug),
            'status'     => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($insert) {
            return redirect()->route('course.category.list')->with('success', 'Course Category Added Successfully!');
        } else {
            return back()->with('error', 'Something Went Wrong!');
        }
    }

    // Show edit form
    public function editCourseCategory($id) {
        $category = DB::table('cms_course_category')->where('id', $id)->first();
        
        if(!$category) {
            return redirect()->route('course.category.list')->with('error', 'Category Not Found!');
        }
        
        return view('admin.cms.course_category.edit', compact('category'));
    }

    // Update category
    public function updateCourseCategory(Request $request, $id) {
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cms_course_category,slug,' . $id,
            'status' => 'nullable|boolean',
        ]);

        $update = DB::table('cms_course_category')->where('id', $id)->update([
            'name'       => $request->name,
            'slug'       => Str::slug($request->slug),
            'status'     => $request->status ?? 0,
            'updated_at' => now(),
        ]);

        return redirect()->route('course.category.list')->with('success', 'Course Category Updated Successfully!');
    }

    // Delete category
    public function destroyCourseCategory($id) {
        DB::table('cms_course_category')->where('id', $id)->delete();
        return redirect()->route('course.category.list')->with('success', 'Course Category Deleted Successfully!');
    }
}
