<?php

namespace App\Http\Controllers\admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Admin;
use Auth;
use Session;
use DB;
use Carbon\Carbon;
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
        // Student Statistics
        $totalStudents = DB::table('student_login')->count();
        $pendingStudents = DB::table('student_login')->where('sl_status', 'PENDING')->count();
        $verifiedStudents = DB::table('student_login')->where('sl_status', 'VERIFIED')->count();
        $resultUpdated = DB::table('student_login')->where('sl_status', 'RESULT UPDATED')->count();
        $resultOut = DB::table('student_login')->where('sl_status', 'RESULT OUT')->count();
        $dispatchedStudents = DB::table('student_login')->where('sl_status', 'DISPATCHED')->count();
        
        // Student registrations by month (last 6 months)
        $studentMonthlyData = DB::table('student_login')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        // Students by status
        $studentsByStatus = DB::table('student_login')
            ->select('sl_status', DB::raw('COUNT(*) as count'))
            ->groupBy('sl_status')
            ->get();
        
        // Recent students (last 30 days)
        $recentStudents = DB::table('student_login')
            ->where('created_at', '>=', Carbon::now()->subDays(30))
            ->count();
        
        // Center Statistics
        $totalCenters = DB::table('center_login')->count();
        $activeCenters = DB::table('center_login')->where('cl_account_status', 'ACTIVE')->count();
        $inactiveCenters = DB::table('center_login')->where('cl_account_status', '!=', 'ACTIVE')->count();
        
        // Total wallet balance from centers
        $totalWalletBalance = DB::table('center_login')->sum('cl_wallet_balance');
        
        // Center registrations by month (last 6 months)
        $centerMonthlyData = DB::table('center_login')
            ->select(DB::raw('MONTH(created_at) as month'), DB::raw('YEAR(created_at) as year'), DB::raw('COUNT(*) as count'))
            ->where('created_at', '>=', Carbon::now()->subMonths(6))
            ->groupBy(DB::raw('MONTH(created_at)'), DB::raw('YEAR(created_at)'))
            ->orderBy('year', 'asc')
            ->orderBy('month', 'asc')
            ->get();
        
        // Top centers by student count
        $topCentersByStudents = DB::table('center_login')
            ->leftJoin('student_login', 'center_login.cl_id', '=', 'student_login.sl_FK_of_center_id')
            ->select('center_login.cl_center_name', 'center_login.cl_id', DB::raw('COUNT(student_login.sl_id) as student_count'))
            ->groupBy('center_login.cl_id', 'center_login.cl_center_name')
            ->orderBy('student_count', 'desc')
            ->limit(5)
            ->get();
        
        // Course Statistics
        $totalCourses = DB::table('course')->count();
        
        // Students by course
        $studentsByCourse = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->select('course.c_full_name', 'course.c_id', DB::raw('COUNT(student_login.sl_id) as student_count'))
            ->groupBy('course.c_id', 'course.c_full_name')
            ->orderBy('student_count', 'desc')
            ->limit(5)
            ->get();
        
        return view('admin.dashboard', compact(
            'totalStudents', 'pendingStudents', 'verifiedStudents', 'resultUpdated', 
            'resultOut', 'dispatchedStudents', 'studentMonthlyData', 'studentsByStatus',
            'recentStudents', 'totalCenters', 'activeCenters', 'inactiveCenters',
            'totalWalletBalance', 'centerMonthlyData', 'topCentersByStudents',
            'totalCourses', 'studentsByCourse'
        ));
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
