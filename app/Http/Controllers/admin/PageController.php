<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = DB::table('cms_pages')->orderBy('id', 'desc')->get();
        return view('admin.cms.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.cms.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cms_pages,slug',
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug if not provided
        $slug = $request->slug;
        if(empty($slug)) {
            $slug = Str::slug($request->title);
        } else {
            $slug = Str::slug($slug);
        }

        // Ensure slug is unique
        $originalSlug = $slug;
        $counter = 1;
        while(DB::table('cms_pages')->where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter;
            $counter++;
        }

        $insert = DB::table('cms_pages')->insert([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($insert) {
            return redirect()->route('pages.list')->with('success', 'Page created successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $page = DB::table('cms_pages')->where('id', $id)->first();
        
        if(!$page) {
            return redirect()->route('pages.list')->with('error', 'Page not found!');
        }
        
        return view('admin.cms.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:cms_pages,slug,' . $id,
            'content' => 'nullable|string',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string|max:255',
            'status' => 'nullable|boolean',
        ]);

        // Generate slug if not provided
        $slug = $request->slug;
        if(empty($slug)) {
            $slug = Str::slug($request->title);
        } else {
            $slug = Str::slug($slug);
        }

        // Check if slug is unique (excluding current page)
        $existingPage = DB::table('cms_pages')->where('slug', $slug)->where('id', '!=', $id)->first();
        if($existingPage) {
            $originalSlug = $slug;
            $counter = 1;
            while(DB::table('cms_pages')->where('slug', $slug)->where('id', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $counter;
                $counter++;
            }
        }

        $update = DB::table('cms_pages')->where('id', $id)->update([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'meta_keywords' => $request->meta_keywords,
            'status' => $request->status ?? 0,
            'updated_at' => now(),
        ]);

        if($update !== false) {
            return redirect()->route('pages.list')->with('success', 'Page updated successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy($id)
    {
        $delete = DB::table('cms_pages')->where('id', $id)->delete();
        
        if($delete) {
            return back()->with('success', 'Page deleted successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
