<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Hash;
use Illuminate\Support\Facades\Schema;
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
        $oldMatches = student_password_matches(
            $student->password,
            student_login_password_candidates($request->old_password)
        );

        if (!$oldMatches && Schema::hasColumn('student_login', 'sl_password')) {
            $oldMatches = student_password_matches(
                $student->sl_password ?? null,
                student_login_password_candidates($request->old_password)
            );
        }

        if (!$oldMatches) {
            return back()->with('error', 'Old Password Does Not Match!');
        }

        $hashed = Hash::make($request->new_password);
        $update = ['password' => $hashed];
        if (Schema::hasColumn('student_login', 'sl_password')) {
            $update['sl_password'] = $hashed;
        }

        Student::where('sl_reg_no', $student->sl_reg_no)->update($update);

        return back()->with('success', 'Password Changed Successfully!');
    }
}
