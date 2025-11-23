<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class DownloadController extends Controller
{
    public function all_download_form(){
        $downloads = DB::table('cms_downloads')->orderBy('id', 'desc')->get();
        return view('admin.cms.downloads.index', compact('downloads'));
    }

    public function add_download_form()
    {
        return view('admin.cms.downloads.create');
    }

    public function handle_download_form(Request $request)
    {

        $filePath = $request->file('file')->store('downloads', 'public');

        DB::table('cms_downloads')->insert([
            'download_name' => $request->download_name,
            'type' => $request->type,
            'file' => $filePath,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->route('all_download_form')->with('success', 'Download added successfully.');
    }

    public function edit_download_form($id)
    {
        $download = DB::table('cms_downloads')->where('id', $id)->first();
        return view('admin.cms.downloads.edit', compact('download'));
    }

    public function update_download_form(Request $request, $id)
    {
        $request->validate([
            'download_name' => 'required|string|max:255',
            'type' => 'required|string|max:100',
            'file' => 'nullable|file|max:2048'
        ]);

        $download = DB::table('cms_downloads')->where('id', $id)->first();

        $filePath = $download->file;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('downloads', 'public');
        }

        DB::table('cms_downloads')->where('id', $id)->update([
            'download_name' => $request->download_name,
            'type' => $request->type,
            'file' => $filePath,
            'updated_at' => now(),
        ]);

        return redirect()->route('all_download_form')->with('success', 'Download updated successfully.');
    }

    // Delete
    public function delete_download_form($id)
    {
        DB::table('cms_downloads')->where('id', $id)->delete();
        return redirect()->route('all_download_form')->with('success', 'Download deleted successfully.');
    }
}
