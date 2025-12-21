<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

class CertificateController extends Controller
{
    // List all certificates (admin panel)
    public function certificate_list()
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
                'center_login.cl_code'
            )
            ->orderBy('student_certificates.sc_id', 'DESC')
            ->get();

        return view('admin.certificate.index', compact('certificates'));
    }

    // View certificate (admin panel)
    public function view_certificate($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->select(
                'student_certificates.*',
                'student_login.*',
                'set_result.*',
                'course.*',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        return view('center.certificate.view', compact('certificate'));
    }
}

