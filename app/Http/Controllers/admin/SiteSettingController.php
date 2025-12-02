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
            $logo = $request->file('site_logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('site_settings'), $logoName);
            $data['site_logo'] = 'site_settings/' . $logoName;
        }

        if ($request->hasFile('site_fav_icon')) {
            $favicon = $request->file('site_fav_icon');
            $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('site_settings'), $faviconName);
            $data['site_fav_icon'] = 'site_settings/' . $faviconName;
        }

        if ($request->hasFile('breadcumb_image')) {
            $breadcumb = $request->file('breadcumb_image');
            $breadcumb_image = time() . '_favicon.' . $breadcumb->getClientOriginalExtension();
            $breadcumb->move(public_path('site_settings'), $breadcumb_image);
            $data['breadcumb_image'] = 'site_settings/' . $breadcumb_image;
        }

        DB::table('site_settings')->updateOrInsert(['id' => 1], $data);

        return redirect()->route('site_settings.edit')->with('success', 'Settings updated successfully.');
    }

}
