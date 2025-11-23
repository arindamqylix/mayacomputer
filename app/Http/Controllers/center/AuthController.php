<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Center;
use App\Models\student\Student;
use Auth; 
use Session;
class AuthController extends Controller
{
    public function center_login(){
    	if(auth::guard('center')->check()):
    		return redirect('center/dashboard');
    	endif;
    	return view('center.auth.login');
    }

    public function center_login_now(Request $request){
        $center = Center::where('cl_code',$request->center_code)->where('cl_account_status','PENDING')->first();
        if($center):
            Session::flash('error', 'Your Account Not Verified! Please Wait for Approval');
    	    return redirect()->back();
        endif;
        
    	if (Auth::guard('center')->attempt(['cl_code'=>$request->center_code,'password'=>$request->mobile])) {
    	   return redirect('center/dashboard');
    	}
    	Session::flash('error', 'Invalid credential');
    	return redirect()->back();
    }

    public function center_logout(){
        Auth::guard('center')->logout();
        return redirect('center/login');
    }

    public function center_dashboard(){
        $data = Center::where('cl_id',Auth::guard('center')->user()->cl_id)->first();
        $all_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->count();
        $pending_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'PENDING')->count();
        $verify_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'VERIFIED')->count();
        $dispatched_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'DISPATCHED')->count();
    	return view('center.dashboard', compact('data', 'all_student', 'pending_student', 'verify_student', 'dispatched_student'));
    }
}
