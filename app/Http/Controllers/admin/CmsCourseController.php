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
			'course_short_name'   => 'required|string|max:255',
			'course_full_name'    => 'required|string|max:255',
			'course_price'        => 'required|string|max:255',
			'course_duration'     => 'required|string|max:255',
			'is_typing_related'   => 'required|in:0,1',
            'description'         => 'nullable|string',
		]);

		try {
			// Insert into DB - using 'course' table
			$insert = DB::table('course')->insert([
				'c_short_name'       => $request->course_short_name,
				'c_full_name'        => $request->course_full_name,
				'c_price'            => $request->course_price,
				'c_duration'         => $request->course_duration,
				'is_typing_related'  => (int) $request->is_typing_related,
                'description'        => $request->description,
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
        if (! $course) {
            return redirect()->route('course.list')->with('error', 'Course not found.');
        }
        $cms = DB::table('cms_course')->where('c_id', $id)->first();
        // Public / listing uses cms_course.category_id; `course` table has no category_id column
        if ($cms) {
            $course->category_id = $cms->category_id ?? $cms->categoy_id ?? null;
        } else {
            $course->category_id = $course->category_id ?? null;
        }
        $categories = DB::table('cms_course_category')->orderBy('name')->get();

        return view('admin.cms.course.edit', compact('course', 'categories'));
    }

    public function update(Request $request, $id) {
        if ($request->input('category_id') === '') {
            $request->merge(['category_id' => null]);
        }
        $request->validate([
            'course_short_name'  => 'required|string|max:255',
            'course_full_name'   => 'required|string|max:255',
            'course_price'       => 'required|string|max:255',
            'course_duration'    => 'required|string|max:255',
            'is_typing_related'  => 'required|in:0,1',
            'description'        => 'nullable|string',
            'category_id'         => 'nullable|integer|exists:cms_course_category,id',
        ]);

        $categoryId = $request->input('category_id') !== null
            ? (int) $request->input('category_id')
            : null;
        $categoryName = $categoryId
            ? DB::table('cms_course_category')->where('id', $categoryId)->value('name')
            : null;

        try {
            DB::table('course')->where('c_id', $id)->update([
                'c_short_name'       => $request->course_short_name,
                'c_full_name'        => $request->course_full_name,
                'c_price'            => $request->course_price,
                'c_duration'         => $request->course_duration,
                'is_typing_related'  => (int) $request->is_typing_related,
                'description'        => $request->description,
                'category_name'      => $categoryName,
                'updated_at'         => now(),
            ]);

            // Website lists / joins use cms_course.category_id (separate from `course` table)
            if (DB::table('cms_course')->where('c_id', $id)->exists()) {
                $cmsRow = [
                    'category_id'   => $categoryId,
                    'category_name' => $categoryName,
                    'categoy_id'   => $categoryId,
                    'updated_at'   => now(),
                ];
                DB::table('cms_course')->where('c_id', $id)->update($cmsRow);
            }

            return redirect()->route('course.list')->with('success', 'Course updated successfully!');
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
