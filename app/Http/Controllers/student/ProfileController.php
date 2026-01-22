<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Models\student\Student;

class ProfileController extends Controller
{
    public function change_password()
    {
        return view('student.change_password');
    }

    public function change_password_save(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:6',
            'confirm_new_password' => 'required|same:new_password',
        ]);

        $student = Auth::guard('student')->user();

        if (Hash::check($request->old_password, $student->sl_password)) {
            // Student model likely uses sl_password but check if it's hashed and if there's a mutator. 
            // Assuming standard Laravel behavior but with custom column name.
            // If the model doesn't handle password hashing automatically, we do it here.
            
            // We need to update the student model to use the custom password field or update explicitly.
            // Since we are using Query Builder or Eloquent, let's try direct update.
            
            $student->sl_password = Hash::make($request->new_password);
            
            // Note: If the Student model has 'password' as hidden or expected field for Auth, 
            // but the column is 'sl_password', the update should work if the model is set up correctly.
            // Let's use specific update to be safe if save() has issues with other fields.
            
            Student::where('sl_id', $student->sl_id)->update([
                'sl_password' => Hash::make($request->new_password)
            ]);
            
            return back()->with('success', 'Password Changed Successfully!');
        } else {
            return back()->with('error', 'Old Password Does Not Match!');
        }
    }
}
