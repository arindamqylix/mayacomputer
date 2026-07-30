<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\admin\Course;
use Illuminate\Http\Request;
use DB;
use Auth;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class AdmitCardController extends Controller
{
    public function download_admit_card($id)
    {
        $courseId = (int) Auth::guard('student')->user()->sl_FK_of_course_id;
        if ($courseId > 0 && Course::qualifiesForTypingCertificateById($courseId)) {
            return redirect()->route('student_dashboard')->with('error', 'Admit cards are not used for your course. Use Typing Certificate from the menu.');
        }

        $admit = DB::table('student_admit_cards')
            ->where('student_id', Auth::guard('student')->user()->sl_id)
            ->first();

        if (!$admit) {
            return back()->with('error', 'Admit Card not found');
        }

        $data = admit_card_view_data($admit->ac_id);
        if (!$data) {
            return back()->with('error', 'Admit Card not found');
        }

        ensure_admit_card_pdf_font();
        $data['forPdf'] = true;
        $pdf = PDF::loadView('admin.admit_card.print', $data);
        $pdf->setPaper('A4', 'portrait');
        $pdf->setOption('isRemoteEnabled', true);
        $pdf->setOption('isHtml5ParserEnabled', true);
        return $pdf->download('Admit_Card_' . $data['student']->sl_reg_no . '.pdf');
    }

    public function view_admit_card()
    {
        $courseId = (int) Auth::guard('student')->user()->sl_FK_of_course_id;
        if ($courseId > 0 && Course::qualifiesForTypingCertificateById($courseId)) {
            return redirect()->route('student_dashboard')->with('error', 'Admit cards are not used for your course. Use Typing Certificate from the menu.');
        }

        // Get student's admit card data
        $admit = DB::table('student_admit_cards')
            ->where('student_id', Auth::guard('student')->user()->sl_id)
            ->first();

        if (!$admit) {
            return redirect()->route('student_dashboard')->with('error', 'Admit Card not found. Please contact your center.');
        }

        $data = admit_card_view_data($admit->ac_id);
        if (!$data) {
            return redirect()->route('student_dashboard')->with('error', 'Admit Card not found. Please contact your center.');
        }

        return view('student.view_admit_card', $data);
    }
}

