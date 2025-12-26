<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\center\Certificate;
use App\Models\center\Student;

class CourierController extends Controller
{
    // List all centers for courier selection
    public function index(Request $request)
    {
        // Get all registered centers
        $centers = DB::table('center_login')
            ->where('cl_account_status', 'ACTIVE')
            ->orderBy('cl_center_name', 'ASC')
            ->get();
        
        $selectedCenterId = $request->get('center_id');
        $students = collect();
        
        // If center is selected, get students with certificates that are not dispatched
        if ($selectedCenterId) {
            $students = DB::table('student_login')
                ->join('student_certificates', 'student_login.sl_id', '=', 'student_certificates.sc_FK_of_student_id')
                ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
                ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
                ->where('student_login.sl_FK_of_center_id', $selectedCenterId)
                ->where('student_login.sl_status', '!=', 'DISPATCHED') // Exclude already dispatched
                ->where(function($query) {
                    // Only show certificates that haven't been dispatched (no dispatch date or tracking number)
                    $query->whereNull('student_certificates.sc_dispatch_date')
                          ->orWhereNull('student_certificates.sc_tracking_number');
                })
                ->select(
                    'student_login.sl_id',
                    'student_login.sl_name',
                    'student_login.sl_reg_no',
                    'student_login.sl_photo',
                    'student_login.sl_status',
                    'student_certificates.sc_id as certificate_id',
                    'student_certificates.sc_certificate_number',
                    'student_certificates.sc_issue_date',
                    'student_certificates.sc_dispatch_date',
                    'student_certificates.sc_tracking_number',
                    'course.c_full_name',
                    'course.c_short_name',
                    'center_login.cl_center_name',
                    'center_login.cl_code'
                )
                ->orderBy('student_login.sl_name', 'ASC')
                ->get();
        }

        return view('admin.courier.index', compact('centers', 'students', 'selectedCenterId'));
    }
    
    // Get students for selected center (AJAX)
    public function getCenterStudents($centerId)
    {
        $students = DB::table('student_login')
            ->join('student_certificates', 'student_login.sl_id', '=', 'student_certificates.sc_FK_of_student_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->where('student_login.sl_status', '!=', 'DISPATCHED')
            ->where(function($query) {
                $query->whereNull('student_certificates.sc_dispatch_date')
                      ->orWhereNull('student_certificates.sc_tracking_number');
            })
            ->select(
                'student_login.sl_id',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'student_certificates.sc_id as certificate_id',
                'student_certificates.sc_certificate_number',
                'student_certificates.sc_issue_date',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        return response()->json($students);
    }

    // Show dispatch form for certificate
    public function dispatch($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_address',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('admin.courier.index')->with('error', 'Certificate not found!');
        }

        return view('admin.courier.dispatch', compact('certificate'));
    }

    // Update dispatch information for multiple students
    public function update_dispatch(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|integer|exists:student_login,sl_id',
            'dispatch_thru' => 'required|string|max:255',
            'dispatch_date' => 'required|date',
            'tracking_number' => 'required|string|max:255',
        ]);

        $studentIds = $request->student_ids;
        $dispatchThru = $request->dispatch_thru;
        $dispatchDate = $request->dispatch_date;
        $trackingNumber = $request->tracking_number;

        // Update all certificates for selected students
        $updated = 0;
        foreach ($studentIds as $studentId) {
            $certificate = DB::table('student_certificates')
                ->where('sc_FK_of_student_id', $studentId)
                ->first();
            
            if ($certificate) {
                DB::table('student_certificates')
                    ->where('sc_id', $certificate->sc_id)
                    ->update([
                        'sc_dispatch_thru' => $dispatchThru,
                        'sc_dispatch_date' => $dispatchDate,
                        'sc_tracking_number' => $trackingNumber,
                        'sc_doc_quantity' => 1, // Default to 1 document per student
                        'updated_at' => now(),
                    ]);
                
                // Update student status to DISPATCHED
                DB::table('student_login')
                    ->where('sl_id', $studentId)
                    ->update(['sl_status' => 'DISPATCHED']);
                
                $updated++;
            }
        }

        return redirect()->route('admin.courier.index')->with('success', "Dispatch information updated successfully for {$updated} student(s)!");
    }
    
    // Update single certificate dispatch information (for backward compatibility)
    public function update_single_dispatch(Request $request, $id)
    {
        $request->validate([
            'dispatch_thru' => 'required|string|max:255',
            'dispatch_date' => 'required|date',
            'tracking_number' => 'required|string|max:255',
            'doc_quantity' => 'required|integer|min:1',
        ]);

        $certificate = Certificate::findOrFail($id);

        $certificate->update([
            'sc_dispatch_thru' => $request->dispatch_thru,
            'sc_dispatch_date' => $request->dispatch_date,
            'sc_tracking_number' => $request->tracking_number,
            'sc_doc_quantity' => $request->doc_quantity,
        ]);
        
        // Update student status to DISPATCHED
        DB::table('student_login')
            ->where('sl_id', $certificate->sc_FK_of_student_id)
            ->update(['sl_status' => 'DISPATCHED']);

        return redirect()->route('admin.courier.index')->with('success', 'Certificate dispatch information updated successfully!');
    }
}

