<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center;
use Auth;
class ProfileController extends Controller
{
	public function profile_update()
	{
		$data = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();
		
		// Check if profile edit is enabled
		if(($data->cl_profile_edit_enabled ?? 0) == 0) {
			return redirect()->route('center_dashboard')->with('error', 'Profile editing is currently disabled by admin. Please contact admin to enable profile editing.');
		}
		
		return view('center.profile_update', compact('data'));
	}

	public function profile_update_now(Request $request)
	{
		$center = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->first();
		
		// Check if profile edit is enabled
		if(($center->cl_profile_edit_enabled ?? 0) == 0) {
			return redirect()->route('center_dashboard')->with('error', 'Profile editing is currently disabled by admin. Please contact admin to enable profile editing.');
		}

		// Default data array
		$data = [
			'cl_code'                => $request->center_code,
			'cl_center_name'         => $request->center_name,
			'cl_director_name'       => $request->director_name,
			'cl_center_address'      => $request->address,
			'cl_cin_no'              => $request->cin_no,
			'cl_email'               => $request->email,
			'cl_mobile'              => $request->mobile,
		];

		// Upload Folder
		$folder = 'center_profile'; // storage/app/public/center_profile

		// Upload Center Photo
		if ($request->hasFile('center_photo')) {
			$file = $request->file('center_photo');
			$filename = time() . '_' . $file->getClientOriginalName();
			$file->storeAs("public/$folder", $filename);
			$data['cl_photo'] = $filename;
		} else {
			$data['cl_photo'] = $center->cl_photo;
		}

		// Upload Center Logo
		if ($request->hasFile('center_logo')) {
			$file = $request->file('center_logo');
			$filename = time() . '_' . $file->getClientOriginalName();
			$file->storeAs("public/$folder", $filename);
			$data['cl_logo'] = $filename;
		} else {
			$data['cl_logo'] = $center->cl_logo;
		}

		// Upload Authorized Signature
		if ($request->hasFile('center_authorized_signature')) {
			$file = $request->file('center_authorized_signature');
			$filename = time() . '_' . $file->getClientOriginalName();
			$file->storeAs("public/$folder", $filename);
			$data['cl_authorized_signature'] = $filename;
		} else {
			$data['cl_authorized_signature'] = $center->cl_authorized_signature;
		}

		// Update Database
		$update = Center::where('cl_id', Auth::guard('center')->user()->cl_id)->update($data);

		if ($update) {
			return back()->with('success', 'Profile Updated Successfully!');
		} else {
			return back()->with('error', 'Something Went Wrong!');
		}
	}


	// change password - DISABLED: Only admin can reset password
	public function change_password()
	{
		return redirect()->route('center_dashboard')->with('error', 'Password change is not available. Please contact admin to reset your password.');
	}

	public function change_password_save(Request $request)
	{
		return redirect()->route('center_dashboard')->with('error', 'Password change is not available. Please contact admin to reset your password.');
	}
}
