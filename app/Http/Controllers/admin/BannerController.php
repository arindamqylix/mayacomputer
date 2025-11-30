<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class BannerController extends Controller
{
    public function all_banner(){
        $banner = DB::table('cms_banner')->orderBy('id', 'desc')->get();
        return view('admin.cms.banner.index', compact('banner'));
    }

    public function add_banner()
    {
        return view('admin.cms.banner.create');
    }

    public function handle_banner(Request $request)
    {
        $request->validate([
            'file' => 'required|image|max:4096' // you can change max size
        ]);


        // upload image
        $uploadedFile = $request->file('file');
        $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
        $uploadedFile->move(public_path('banner'), $fileName);

        // save path to DB
        DB::table('cms_banner')->insert([
            'file'       => 'banner/' . $fileName,  // relative path
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('all_banner')->with('success', 'Image added successfully.');
    }


    public function edit_banner($id)
    {
        $banner = DB::table('cms_banner')->where('id', $id)->first();
        return view('admin.cms.banner.edit', compact('banner'));
    }

    public function update_banner(Request $request, $id)
    {
        $request->validate([
            'file' => 'nullable|image|max:4096' // you can increase size if needed
        ]);

        $banner = DB::table('cms_banner')->where('id', $id)->first();

        // Keep old file path by default
        $filePath = $banner->file;

        // If new image uploaded
        if ($request->hasFile('file')) {


            // delete old image if exists
            if (!empty($banner->file) && file_exists(public_path($banner->file))) {
                unlink(public_path($banner->file));
            }

            // upload new image
            $uploadedFile = $request->file('file');
            $fileName = time() . '_' . uniqid() . '.' . $uploadedFile->getClientOriginalExtension();
            $uploadedFile->move(public_path('banner'), $fileName);

            // save new path
            $filePath = 'banner/' . $fileName;
        }

        // DB update
        DB::table('cms_banner')->where('id', $id)->update([
            'file'       => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('all_banner')->with('success', 'banner updated successfully.');
    }


    // Delete
    public function delete_banner($id)
    {
        DB::table('cms_banner')->where('id', $id)->delete();
        return redirect()->route('all_banner')->with('success', 'Download deleted successfully.');
    }
}
