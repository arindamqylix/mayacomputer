<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Auth;
use Session;
class AuthController extends Controller
{
    public function admin_login()
    {
        if (auth::guard('admin')->check()):
            return redirect('admin/dashboard');
        endif;
        return view('admin.auth.login');
    }

    public function admin_login_now(Request $request)
    {
        if (Auth::guard('admin')->attempt(['al_email' => $request->email, 'password' => $request->password])) {
            return redirect('admin/dashboard');
        }
        Session::flash('error', 'Invalid credential');
        return redirect()->back();
    }

    public function admin_logout()
    {
        Auth::guard('admin')->logout();
        return redirect('admin/login');
    }

    public function admin_dashboard()
    {
        return view('admin.dashboard');
    }

    // change password
    public function change_password()
    {
        return view('admin.auth.change_password');
    }

    public function change_password_save(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'new_password' => 'required|min:6',
            'confirm_password' => 'required|same:new_password',
        ], [
            'new_password.required' => 'Please enter a new password.',
            'new_password.min' => 'The new password must be at least 6 characters.',
            'confirm_password.required' => 'Please confirm your new password.',
            'confirm_password.same' => 'Confirm password does not match new password.',
        ]);
        $admin = Auth::guard('admin')->user();
        $login = Admin::where('al_id', $admin->al_id)->first();

        if (!$login) {
            return back()->with('error', 'Login record not found.');
        }
        $login->password = bcrypt($request->new_password);
        $login->save();

        return back()->with('success', 'Password Changed Successfully!');
    }


    public function profile_update()
    {
        $data = Admin::where('al_id', Auth::guard('admin')->user()->al_id)->first();
        return view('admin.profile_update', compact('data'));
    }

    public function profile_update_now(Request $request)
    {
        $admin = Admin::where('cl_id', Auth::guard('admin')->user()->cl_id)->first();

        if ($request->hasFile('admin_photo')):
            $image = $request->file('admin_photo');
            $file = time() . '_' . $image->getClientOriginalName();
            $image->move('admin/admin_image', $file);
            $data['cl_photo'] = $file;
            $admin_photo = $file;
        else:
            $admin_photo = $admin->cl_photo;
        endif;

        if ($request->hasFile('admin_logo')):
            $image = $request->file('admin_logo');
            $file = time() . '_' . $image->getClientOriginalName();
            $image->move('admin/admin_image', $file);
            $data['cl_logo'] = $file;
            $admin_logo = $file;
        else:
            $admin_logo = $admin->cl_logo;
        endif;

        if ($request->hasFile('admin_authorized_signature')):
            $image = $request->file('admin_authorized_signature');
            $file = time() . '_' . $image->getClientOriginalName();
            $image->move('admin/admin_image', $file);
            $data['cl_authorized_signature'] = $file;
            $admin_authorized_signature = $file;
        else:
            $admin_authorized_signature = $admin->cl_logo;
        endif;

        $data = [
            'cl_code' => $request->admin_code,
            'cl_admin_name' => $request->admin_name,
            'cl_director_name' => $request->director_name,
            'cl_admin_address' => $request->address,
            'cl_cin_no' => $request->cin_no,
            'cl_email' => $request->email,
            'cl_mobile' => $request->mobile,
            'cl_photo' => $admin_photo,
            'cl_logo' => $admin_logo,
            'cl_authorized_signature' => $admin_authorized_signature,
        ];

        $update = Admin::where('cl_id', Auth::guard('admin')->user()->cl_id)->update($data);

        if ($update):
            return back()->with('success', 'Profile Updated Successfully!');
        else:
            return back()->with('success', 'Something Went Wrong!');
        endif;
    }
}
