<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class HomepageController extends Controller
{
    public function index()
    {
        // Group sections by type
        $counterStats = DB::table('cms_homepage_sections')->where('section_type', 'counter_stat')->where('status', 1)->orderBy('sort_order')->get();
        $aboutUsHeader = DB::table('cms_homepage_sections')->where('section_type', 'about_us_header')->first();
        $aboutUsItems = DB::table('cms_homepage_sections')->where('section_type', 'about_us_item')->where('status', 1)->orderBy('sort_order')->get();
        $whyChooseHeader = DB::table('cms_homepage_sections')->where('section_type', 'why_choose_header')->first();
        $whyChooseItems = DB::table('cms_homepage_sections')->where('section_type', 'why_choose_item')->where('status', 1)->orderBy('sort_order')->get();
        $serviceItems = DB::table('cms_homepage_sections')->where('section_type', 'service_item')->where('status', 1)->orderBy('sort_order')->get();
        $achievementHeader = DB::table('cms_homepage_sections')->where('section_type', 'achievement_header')->first();
        $achievementCounters = DB::table('cms_homepage_sections')->where('section_type', 'achievement_counter')->where('status', 1)->orderBy('sort_order')->get();
        $partnerHeader = DB::table('cms_homepage_sections')->where('section_type', 'partner_header')->first();
        $partnerItems = DB::table('cms_homepage_sections')->where('section_type', 'partner_item')->where('status', 1)->orderBy('sort_order')->get();

        return view('admin.cms.homepage.index', compact(
            'counterStats', 'aboutUsHeader', 'aboutUsItems', 
            'whyChooseHeader', 'whyChooseItems', 'serviceItems',
            'achievementHeader', 'achievementCounters', 'partnerHeader', 'partnerItems'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'section_type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'number' => 'nullable|string|max:50',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url|max:500',
            'link' => 'nullable|url|max:500',
            'link_text' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('homepage'), $imageName);
            $imagePath = 'homepage/' . $imageName;
        }

        // Get max sort_order for this section type
        $maxSortOrder = DB::table('cms_homepage_sections')
            ->where('section_type', $request->section_type)
            ->max('sort_order') ?? 0;

        $insert = DB::table('cms_homepage_sections')->insert([
            'section_type' => $request->section_type,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'icon' => $request->icon,
            'number' => $request->number,
            'label' => $request->label,
            'image' => $imagePath,
            'video_url' => $request->video_url,
            'link' => $request->link,
            'link_text' => $request->link_text,
            'content' => $request->content,
            'sort_order' => $request->sort_order ?? ($maxSortOrder + 1),
            'status' => $request->status ?? 1,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        if($insert) {
            return back()->with('success', 'Section added successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function edit($id)
    {
        $section = DB::table('cms_homepage_sections')->where('id', $id)->first();
        
        if(!$section) {
            return redirect()->route('homepage.index')->with('error', 'Section not found!');
        }
        
        return view('admin.cms.homepage.edit', compact('section'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'section_type' => 'required|string|max:50',
            'title' => 'nullable|string|max:255',
            'subtitle' => 'nullable|string',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:100',
            'number' => 'nullable|string|max:50',
            'label' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url|max:500',
            'link' => 'nullable|url|max:500',
            'link_text' => 'nullable|string|max:255',
            'content' => 'nullable|string',
            'sort_order' => 'nullable|integer',
            'status' => 'nullable|boolean',
        ]);

        $section = DB::table('cms_homepage_sections')->where('id', $id)->first();
        if(!$section) {
            return back()->with('error', 'Section not found!');
        }

        $imagePath = $section->image;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if($imagePath && file_exists(public_path($imagePath))) {
                @unlink(public_path($imagePath));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('homepage'), $imageName);
            $imagePath = 'homepage/' . $imageName;
        }

        $update = DB::table('cms_homepage_sections')->where('id', $id)->update([
            'section_type' => $request->section_type,
            'title' => $request->title,
            'subtitle' => $request->subtitle,
            'description' => $request->description,
            'icon' => $request->icon,
            'number' => $request->number,
            'label' => $request->label,
            'image' => $imagePath,
            'video_url' => $request->video_url,
            'link' => $request->link,
            'link_text' => $request->link_text,
            'content' => $request->content,
            'sort_order' => $request->sort_order ?? $section->sort_order,
            'status' => $request->status ?? 0,
            'updated_at' => now(),
        ]);

        if($update !== false) {
            return redirect()->route('homepage.index')->with('success', 'Section updated successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }

    public function destroy($id)
    {
        $section = DB::table('cms_homepage_sections')->where('id', $id)->first();
        
        if($section && $section->image && file_exists(public_path($section->image))) {
            unlink(public_path($section->image));
        }

        $delete = DB::table('cms_homepage_sections')->where('id', $id)->delete();
        
        if($delete) {
            return back()->with('success', 'Section deleted successfully!');
        } else {
            return back()->with('error', 'Something went wrong!');
        }
    }
}
