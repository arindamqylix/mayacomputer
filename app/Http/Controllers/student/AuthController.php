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
    	$request->validate([
    		'reg_no' => 'required|string',
    		'mobile' => 'required|string',
    	]);

    	$student = student_find_for_login($request->reg_no, $request->mobile);
    	if ($student) {
    		Auth::guard('student')->login($student);
    		return redirect('student/dashboard');
    	}

    	Session::flash('error', 'Invalid Registration Number or Password');
    	return redirect()->back()->withInput(['reg_no' => $request->reg_no]);
    }

    public function student_logout(){
        Auth::guard('student')->logout();
        return redirect('student/login');
    }

    public function student_dashboard(){
		 $convId = ChatConversations::getOrCreateStudentCenterConversation();
		 $user = Auth::guard('student')->user();
    	$data = DB::table('student_login')
    			->leftJoin('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
    			->leftJoin('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
    			->where('student_login.sl_id', $user->sl_id)
                ->select(
                    'student_login.*',
                    'center_login.cl_center_name', 
                    'center_login.cl_code', 
                    'center_login.cl_center_address',
                    'center_login.cl_mobile',
                    'center_login.cl_email',
                    'course.c_short_name', 
                    'course.c_full_name',
                    'course.c_duration'
                )
    			->first();

		$enrolledCourses = student_course_enrollment_rows((int) $user->sl_FK_of_center_id, null)
			->filter(fn ($row) => (string) $row->sl_reg_no === (string) $user->sl_reg_no)
			->values();
		$courseNames = student_course_names((string) $user->sl_reg_no, (int) $user->sl_FK_of_center_id);

    	return view('student.dashboard', compact('data', 'convId', 'enrolledCourses', 'courseNames'));
    }
}
