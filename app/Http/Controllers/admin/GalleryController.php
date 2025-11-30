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
        $request->validate([
            'file' => 'required|image|max:4096' // you can change max size
        ]);


        // upload image
        $uploadedFile = $request->file('file');
        $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(public_path('gallery'), $fileName);

        // save path to DB
        DB::table('cms_gallery')->insert([
            'file'       => 'gallery/' . $fileName,  // relative path
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('all_gallery')->with('success', 'Image added successfully.');
    }


    public function edit_gallery($id)
    {
        $gallery = DB::table('cms_gallery')->where('id', $id)->first();
        return view('admin.cms.gallery.edit', compact('gallery'));
    }

    public function update_gallery(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|image|max:4096' // you can increase size if needed
        ]);

        $gallery = DB::table('cms_gallery')->where('id', $id)->first();

        // Keep old file path by default
        $filePath = $gallery->file;

        // If new image uploaded
        if ($request->hasFile('file')) {


            // delete old image if exists
            if (!empty($gallery->file) && file_exists(public_path($gallery->file))) {
                unlink(public_path($gallery->file));
            }

            // upload new image
            $uploadedFile = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('gallery'), $fileName);

            // save new path
            $filePath = 'gallery/' . $fileName;
        }

        // DB update
        DB::table('cms_gallery')->where('id', $id)->update([
            'file'       => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('all_gallery')->with('success', 'Gallery updated successfully.');
    }


    // Delete
    public function delete_gallery($id)
    {
        DB::table('cms_gallery')->where('id', $id)->delete();
        return redirect()->route('all_gallery')->with('success', 'Download deleted successfully.');
    }
}
