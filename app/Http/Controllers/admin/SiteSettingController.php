<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class SiteSettingController extends Controller
{
    public function edit()
    {
        $setting = DB::table('site_settings')->first();
        return view('admin.cms.site_settings.edit', compact('setting'));
    }

    public function update(Request $request)
    {
        $data = $request->only(['name', 'email', 'phone', 'address', 'copyright']);
        if ($request->hasFile('site_logo')) {
            $data['site_logo'] = $request->file('site_logo')->store('site_settings', 'public');
        }

        if ($request->hasFile('site_fav_icon')) {
            $data['site_fav_icon'] = $request->file('site_fav_icon')->store('site_settings', 'public');
        }

        DB::table('site_settings')->updateOrInsert(['id' => 1], $data);

        return redirect()->route('site_settings.edit')->with('success', 'Settings updated successfully.');
    }
}
