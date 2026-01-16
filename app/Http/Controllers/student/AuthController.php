<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\student\Student;
use Auth;
use Session;
use DB;
use App\Helpers\ChatConversations;
class AuthController extends Controller
{
    public function student_login(){
    	if(auth::guard('student')->check()):
    		return redirect('student/dashboard');
    	endif;
    	return view('student.auth.login');
    }

    public function student_login_now(Request $request){
    	if (Auth::guard('student')->attempt(['sl_reg_no'=>$request->reg_no,'password'=>$request->mobile])) {
    	   return redirect('student/dashboard');
    	}
    	Session::flash('error', 'Invalid credential');
    	return redirect()->back();
    }

    public function student_logout(){
        Auth::guard('student')->logout();
        return redirect('student/login');
    }

    public function student_dashboard(){
		 $convId = ChatConversations::getOrCreateStudentCenterConversation();
    	$data = DB::table('student_login')
    			->leftJoin('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
    			->leftJoin('course', 'student_login.sl_FK_of_course_id', 'course.c_id')
    			->where('student_login.sl_id', Auth::guard('student')->user()->sl_id)
    			->first();
    			// dd($data);
    	return view('student.dashboard', compact('data','convId'));
    }
}
