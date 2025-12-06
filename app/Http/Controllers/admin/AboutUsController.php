<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class AboutUsController extends Controller
{
    public function index()
    {
        $aboutSections = DB::table('cms_about_us')->orderBy('sort_order', 'asc')->orderBy('id', 'asc')->get();
        return view('admin.cms.about_us.index', compact('aboutSections'));
    }

    public function create()
    {
        return view('admin.cms.about_us.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('about_us'), $imageName);
            $path = 'about_us/' . $imageName;
        }

        DB::table('cms_about_us')->insert([
            'title' => $request->title,
            'section' => $request->section,
            'image' => $path,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('about_us.list')->with('success', 'About Us section added successfully!');
    }

    public function edit($id)
    {
        $section = DB::table('cms_about_us')->where('id', $id)->first();
        
        if(!$section) {
            return redirect()->route('about_us.list')->with('error', 'Section not found!');
        }
        
        return view('admin.cms.about_us.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'section' => 'nullable|string|max:100',
            'image' => 'nullable|image',
            'description' => 'nullable|string',
            'video_url' => 'nullable|url',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $existingImage = DB::table('cms_about_us')->where('id', $id)->value('image');

        $path = $existingImage;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('about_us'), $imageName);
            $path = 'about_us/' . $imageName;
            
            // Delete old image if exists
            if($existingImage && file_exists(public_path($existingImage))) {
                unlink(public_path($existingImage));
            }
        }

        DB::table('cms_about_us')->where('id', $id)->update([
            'title' => $request->title,
            'section' => $request->section,
            'image' => $path,
            'description' => $request->description,
            'video_url' => $request->video_url,
            'sort_order' => $request->sort_order ?? 0,
            'status' => $request->status ?? 0,
            'updated_at' => now(),
        ]);

        return redirect()->route('about_us.list')->with('success', 'About Us section updated successfully!');
    }

    public function destroy($id)
    {
        $section = DB::table('cms_about_us')->where('id', $id)->first();
        
        if($section && $section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }
        
        DB::table('cms_about_us')->where('id', $id)->delete();
        
        return back()->with('success', 'About Us section deleted successfully!');
    }
}
