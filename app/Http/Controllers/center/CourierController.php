<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Carbon\Carbon;

class CourierController extends Controller
{
    public function index()
    {
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Get all dispatched certificates for this center
        $couriers = DB::table('student_certificates')
            ->leftJoin('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->leftJoin('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_certificates.sc_FK_of_center_id', $centerId)
            ->whereNotNull('student_certificates.sc_dispatch_date')
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_short_name',
                'course.c_full_name'
            )
            ->orderBy('student_certificates.sc_dispatch_date', 'DESC')
            ->orderBy('student_certificates.sc_tracking_number', 'ASC')
            ->get();
            
        // Group by tracking number for better display if needed, or just list them
        // The user asked for "Courier Details... or student list bhi"
        // So listing students with their courier details seems appropriate.
        
        return view('center.courier.index', compact('couriers'));
    }
    
    public function update_received(Request $request)
    {
        $request->validate([
            'tracking_number' => 'required|string',
        ]);
        
        $trackingNumber = $request->tracking_number;
        $centerId = Auth::guard('center')->user()->cl_id;
        
        // Bulk update for all certificates in this courier
        $updated = DB::table('student_certificates')
            ->where('sc_tracking_number', $trackingNumber)
            ->where('sc_FK_of_center_id', $centerId)
            ->update([
                'sc_status' => 'RECEIVED',
                'updated_at' => now()
            ]);
            
        if ($updated) {
            return back()->with('success', 'Courier marked as Received successfully!');
        } else {
            return back()->with('error', 'Failed to update status. Please try again or verify if it was already updated.');
        }
    }
}
