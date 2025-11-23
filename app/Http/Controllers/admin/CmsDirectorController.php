<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CmsDirectorController extends Controller
{
    public function index()
    {
        $directors = DB::table('cms_directors')->get();
        return view('admin.cms.director.index', compact('directors'));
    }

    public function create()
    {
        return view('admin.cms.director.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image',
            'designation' => 'nullable|string|max:255',
        ]);

        $path = null;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('directors', 'public');
        }

        DB::table('cms_directors')->insert([
            'name'        => $request->name,
            'image'       => $path,
            'designation' => $request->designation,
            'type' => $request->type,
            'created_at'  => now(),
            'updated_at'  => now(),
        ]);

        return redirect()->route('director_list')->with('success', 'Director added successfully!');
    }

    public function edit($id)
    {
        $director = DB::table('cms_directors')->where('id', $id)->first();
        return view('admin.cms.director.edit', compact('director'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'image'       => 'nullable|image',
            'designation' => 'nullable|string|max:255',
        ]);

        $existingImage = DB::table('cms_directors')->where('id', $id)->value('image');

        $path = $existingImage;
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('directors', 'public');
        }

        DB::table('cms_directors')->where('id', $id)->update([
            'name'        => $request->name,
            'image'       => $path,
            'designation' => $request->designation,
            'type' => $request->type,
            'updated_at'  => now(),
        ]);

        return redirect()->route('director_list')->with('success', 'Director updated successfully!');
    }

    public function destroy($id)
    {
        DB::table('cms_directors')->where('id', $id)->delete();
        return redirect()->route('director_list')->with('success', 'Director deleted successfully!');
    }
}
