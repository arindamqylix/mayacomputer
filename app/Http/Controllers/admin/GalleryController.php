<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class GalleryController extends Controller
{
    public function all_gallery(){
        $gallery = DB::table('cms_gallery')->orderBy('id', 'desc')->get();
        return view('admin.cms.gallery.index', compact('gallery'));
    }

    public function add_gallery()
    {
        return view('admin.cms.gallery.create');
    }

    public function handle_gallery(Request $request)
    {

        $filePath = $request->file('file')->store('gallery', 'public');

        DB::table('cms_gallery')->insert([
            'file' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('all_gallery')->with('success', 'Download added successfully.');
    }

    public function edit_gallery($id)
    {
        $gallery = DB::table('cms_gallery')->where('id', $id)->first();
        return view('admin.cms.gallery.edit', compact('gallery'));
    }

    public function update_gallery(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|file|max:2048'
        ]);

        $gallery = DB::table('cms_gallery')->where('id', $id)->first();

        $filePath = $gallery->file;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('gallery', 'public');
        }

        DB::table('cms_gallery')->where('id', $id)->update([
            'file' => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('all_gallery')->with('success', 'Download updated successfully.');
    }

    // Delete
    public function delete_gallery($id)
    {
        DB::table('cms_gallery')->where('id', $id)->delete();
        return redirect()->route('all_gallery')->with('success', 'Download deleted successfully.');
    }
}
