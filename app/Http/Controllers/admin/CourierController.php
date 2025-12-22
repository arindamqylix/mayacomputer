<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\center\Certificate;
use App\Models\center\Student;

class CourierController extends Controller
{
    // List all certificates with dispatch information
    public function index()
    {
        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->orderBy('student_certificates.sc_id', 'DESC')
            ->get();

        return view('admin.courier.index', compact('certificates'));
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

    // Update certificate dispatch information
    public function update_dispatch(Request $request, $id)
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

        return redirect()->route('admin.courier.index')->with('success', 'Certificate dispatch information updated successfully!');
    }
}

