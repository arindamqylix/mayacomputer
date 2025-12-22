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
        // First check if center exists and get status
        $center = Center::where('cl_code', $request->center_code)->first();
        
        if (!$center):
            Session::flash('error', 'Invalid credential');
            return redirect()->back();
        endif;
        
        // Check if center status is PENDING or BLOCKED
        if($center->cl_account_status == 'PENDING'):
            Session::flash('error', 'Your Account is Not Approved Yet! Please Wait for Admin Approval.');
            return redirect()->back();
        endif;
        
        if($center->cl_account_status == 'BLOCKED'):
            Session::flash('error', 'Your Account is Blocked! Please Contact Admin.');
            return redirect()->back();
        endif;
        
        // Only allow ACTIVE or APPROVED centers to login
        if($center->cl_account_status != 'ACTIVE' && $center->cl_account_status != 'APPROVED'):
            Session::flash('error', 'Your Account is Not Active! Please Contact Admin.');
            return redirect()->back();
        endif;
        
        // Attempt authentication
    	if (Auth::guard('center')->attempt(['cl_code'=>$request->center_code,'password'=>$request->mobile])) {
            // Double check status after authentication
            $authenticatedCenter = Auth::guard('center')->user();
            if($authenticatedCenter->cl_account_status != 'ACTIVE' && $authenticatedCenter->cl_account_status != 'APPROVED'):
                Auth::guard('center')->logout();
                Session::flash('error', 'Your Account is Not Active! Please Contact Admin.');
                return redirect()->back();
            endif;
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
        // Check if center status is active
        $authenticatedCenter = Auth::guard('center')->user();
        if($authenticatedCenter->cl_account_status != 'ACTIVE' && $authenticatedCenter->cl_account_status != 'APPROVED'):
            Auth::guard('center')->logout();
            Session::flash('error', 'Your Account is Not Active! Please Contact Admin.');
            return redirect()->route('center_login');
        endif;
        
        $data = Center::where('cl_id',Auth::guard('center')->user()->cl_id)->first();
        $all_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->count();
        $pending_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'PENDING')->count();
        $verify_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'VERIFIED')->count();
        $dispatched_student = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->where('sl_status', 'DISPATCHED')->count();
    	return view('center.dashboard', compact('data', 'all_student', 'pending_student', 'verify_student', 'dispatched_student'));
    }
}
