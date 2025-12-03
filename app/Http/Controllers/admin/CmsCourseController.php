<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CmsCourseController extends Controller
{
    public function index() {
        $courses = DB::table('cms_course')
            ->leftJoin('cms_course_category', 'cms_course.category_id', '=', 'cms_course_category.id')
            ->select('cms_course.*', 'cms_course_category.name as category_name')
            ->get();
        return view('admin.cms.course.index', compact('courses'));
    }

    public function create() {
        $categories = DB::table('cms_course_category')->where('status', 1)->get();
        return view('admin.cms.course.create', compact('categories'));
    }

    public function store(Request $request) {
        // Validation
		$request->validate([
			'course_short_name' => 'required|string|max:255',
			'course_full_name'  => 'required|string|max:255',
			'course_price'      => 'required|numeric',
			'course_duration'   => 'required|string|max:100',
			'category_id'       => 'nullable|integer|exists:cms_course_category,id',
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

		// Generate slug if not provided or empty
		$slug = $request->slug;
		if(empty($slug)) {
			$slug = Str::slug($request->course_full_name);
		} else {
			$slug = Str::slug($slug);
		}
		
		// Ensure slug is unique
		$originalSlug = $slug;
		$counter = 1;
		while(DB::table('cms_course')->where('slug', $slug)->exists()) {
			$slug = $originalSlug . '-' . $counter;
			$counter++;
		}

		// Insert into DB
		$insert = DB::table('cms_course')->insert([
            'c_short_name'     => $request->course_short_name,
            'category_id'      => $request->category_id,
            'c_full_name'      => $request->course_full_name,
            'c_price'          => $request->course_price,
            'c_duration'       => $request->course_duration,
            'file'             => $filePath,
            'description'      => $request->description,
            'information'      => json_encode($information),
            'course_syllabus'  => json_encode($syllabus),
            'slug'             => $slug,
            'created_at'       => now(),
            'updated_at'       => now(),
        ]);
        

		if($insert){
			return back()->with('success', 'Course Added Successfully!');
		} else {
			return back()->with('error', 'Something Went Wrong!');
		}
    }

    public function edit($id) {
        $course = DB::table('cms_course')->where('c_id', $id)->first();
        $categories = DB::table('cms_course_category')->where('status', 1)->get();
        return view('admin.cms.course.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id) {
        // Validation
        $request->validate([
            'course_short_name' => 'required|string|max:255',
            'course_full_name'  => 'required|string|max:255',
            'course_price'      => 'required|numeric',
            'course_duration'   => 'required|string|max:100',
            'category_id'       => 'nullable|integer|exists:cms_course_category,id',
            'file'              => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'description'       => 'nullable|string',
        ]);

        // File upload
        $filePath = DB::table('cms_course')->where('c_id', $id)->value('file');
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

        // Generate slug if not provided or empty
        $slug = $request->slug;
        if(empty($slug)) {
            $slug = Str::slug($request->course_full_name);
        } else {
            $slug = Str::slug($slug);
        }
        
        // Ensure slug is unique (excluding current course)
        $originalSlug = $slug;
        $counter = 1;
        while(DB::table('cms_course')->where('slug', $slug)->where('c_id', '!=', $id)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        DB::table('cms_course')->where('c_id', $id)->update([
            'c_short_name'     => $request->course_short_name,
            'category_id'      => $request->category_id,
            'c_full_name'      => $request->course_full_name,
            'c_price'          => $request->course_price,
            'c_duration'       => $request->course_duration,
            'file'             => $filePath,
            'description'      => $request->description,
            'information'      => json_encode($information),
            'course_syllabus'  => json_encode($syllabus),
            'slug'             => $slug,
            'updated_at'       => now(),
        ]);

        return redirect()->route('course.list')->with('success', 'Course updated successfully!');
    }

    public function destroy($id) {
        DB::table('cms_course')->where('c_id', $id)->delete();
        return redirect()->route('course.list')->with('success', 'Course deleted successfully!');
    }
}
