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
        $data = $request->only(['name', 'email', 'phone', 'address', 'corporate_address', 'copyright', 'facebook', 'twitter', 'instagram', 'youtube']);

        if ($request->hasFile('site_logo')) {
            $logo = $request->file('site_logo');
            $logoName = time() . '_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('site_settings'), $logoName);
            $data['site_logo'] = 'site_settings/' . $logoName;
        }

        if ($request->hasFile('document_logo')) {
            $docLogo = $request->file('document_logo');
            $docLogoName = time() . '_doc_logo.' . $docLogo->getClientOriginalExtension();
            $docLogo->move(public_path('site_settings'), $docLogoName);
            $data['document_logo'] = 'site_settings/' . $docLogoName;
        }

        if ($request->hasFile('certificate_footer_logos')) {
            $footerLogos = [];
            foreach($request->file('certificate_footer_logos') as $key => $file) {
                $name = time() . '_footer_logo_' . $key . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('site_settings'), $name);
                $footerLogos[] = 'site_settings/' . $name;
            }
            $data['certificate_footer_logos'] = json_encode($footerLogos);
        }

        if ($request->hasFile('site_fav_icon')) {
            $favicon = $request->file('site_fav_icon');
            $faviconName = time() . '_favicon.' . $favicon->getClientOriginalExtension();
            $favicon->move(public_path('site_settings'), $faviconName);
            $data['site_fav_icon'] = 'site_settings/' . $faviconName;
        }

        if ($request->hasFile('breadcumb_image')) {
            $breadcumb = $request->file('breadcumb_image');
            $breadcumb_image = time() . '_breadcumb.' . $breadcumb->getClientOriginalExtension();
            $breadcumb->move(public_path('site_settings'), $breadcumb_image);
            $data['breadcumb_image'] = 'site_settings/' . $breadcumb_image;
        }

        if ($request->hasFile('authorize_stamp')) {
            $stamp = $request->file('authorize_stamp');
            $stampName = time() . '_stamp.' . $stamp->getClientOriginalExtension();
            $stamp->move(public_path('site_settings'), $stampName);
            $data['authorize_stamp'] = 'site_settings/' . $stampName;
        }

        if ($request->hasFile('authorize_signature')) {
            $signature = $request->file('authorize_signature');
            $signatureName = time() . '_signature.' . $signature->getClientOriginalExtension();
            $signature->move(public_path('site_settings'), $signatureName);
            $data['authorize_signature'] = 'site_settings/' . $signatureName;
        }

        if ($request->hasFile('admin_profile_logo')) {
            $logo = $request->file('admin_profile_logo');
            $logoName = time() . '_admin_logo.' . $logo->getClientOriginalExtension();
            $logo->move(public_path('site_settings'), $logoName);
            $data['admin_profile_logo'] = 'site_settings/' . $logoName;
        }

        DB::table('site_settings')->updateOrInsert(['id' => 1], $data);

        return redirect()->route('site_settings.edit')->with('success', 'Settings updated successfully.');
    }

}
