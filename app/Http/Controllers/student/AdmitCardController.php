<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AdmitCardController extends Controller
{
    public function download_admit_card($id)
    {
        $admit = DB::table('student_admit_cards')
            ->where('student_id', Auth::guard('student')->user()->sl_id)
            ->first();

        if (!$admit) {
            return back()->with('error', 'Admit Card not found');
        }

        $student = DB::table('student_login')
            ->where('sl_id', $admit->student_id)
            ->first();

        $course = DB::table('course')
            ->where('c_id', $student->sl_FK_of_course_id)
            ->first();

        $center = DB::table('center_login')
            ->where('cl_id', $admit->center_id)
            ->first();

        $setting = DB::table('site_settings')->first();

        $data = [
            'admit' => $admit,
            'student' => $student,
            'course' => $course,
            'center' => $center,
            'setting' => $setting
        ];

        $pdf = PDF::loadView('admin.admit_card.pdf', $data);
        $pdf->setPaper('A4', 'portrait');
        return $pdf->download('Admit_Card_' . $student->sl_reg_no . '.pdf');
    }

    public function view_admit_card()
    {
        // Get student's admit card data
        $admit = DB::table('student_admit_cards')
            ->where('student_id', Auth::guard('student')->user()->sl_id)
            ->first();

        if (!$admit) {
            return redirect()->route('student_dashboard')->with('error', 'Admit Card not found. Please contact your center.');
        }

        // Get student details
        $student = DB::table('student_login')
            ->where('sl_id', $admit->student_id)
            ->first();

        // Get course details
        $course = DB::table('course')
            ->where('c_id', $student->sl_FK_of_course_id)
            ->first();

        // Get center details
        $center = DB::table('center_login')
            ->where('cl_id', $admit->center_id)
            ->first();

        $setting = DB::table('site_settings')->first();
        return view('student.view_admit_card', compact('admit', 'student', 'course', 'center', 'setting'));
    }
}

