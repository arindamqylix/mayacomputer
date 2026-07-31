<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use App\Models\admin\Course;
use Auth;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use DB;

class AdmitCardController extends Controller
{
    public function admit_list()
    {
        $user = Auth::guard('student')->user();
        $enrollments = $this->enrollmentsForStudent($user);

        if ($enrollments->isEmpty()) {
            return redirect()->route('student_dashboard')->with(
                'error',
                'Admit cards are not used for your course. Use Typing Certificate from the menu.'
            );
        }

        $admitByCourse = $this->admitCardsByCourse($user);

        return view('student.admit_card.list', compact('enrollments', 'admitByCourse'));
    }

    public function view_admit_card($courseId)
    {
        $user = Auth::guard('student')->user();
        $courseId = (int) $courseId;

        if (Course::qualifiesForTypingCertificateById($courseId)) {
            return redirect()->route('view_admit_card')->with('error', 'Admit cards are not used for typing courses.');
        }

        $enrollments = $this->enrollmentsForStudent($user);
        $enrollment = $enrollments->first(fn ($row) => (int) $row->course_id === $courseId);

        if (!$enrollment) {
            return redirect()->route('view_admit_card')->with('error', 'Admit card not found for this course.');
        }

        $admit = $this->admitCardsByCourse($user)->get($courseId);

        if (!$admit) {
            return redirect()->route('view_admit_card')->with(
                'error',
                'Admit card for ' . ($enrollment->c_short_name ?? 'this course') . ' has not been generated yet. Please contact your center.'
            );
        }

        $data = admit_card_view_data($admit->ac_id);
        if (!$data) {
            return redirect()->route('view_admit_card')->with('error', 'Admit card not found. Please contact your center.');
        }

        return view('student.view_admit_card', $data);
    }

    public function download_admit_card($id)
    {
        $admit = DB::table('student_admit_cards')->where('ac_id', (int) $id)->first();

        if (!$admit || !$this->admitOwnedByStudent($admit)) {
            return back()->with('error', 'Admit Card not found');
        }

        if (Course::qualifiesForTypingCertificateById((int) $admit->course_id)) {
            return redirect()->route('view_admit_card')->with('error', 'Admit cards are not used for typing courses.');
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

    private function enrollmentsForStudent($user)
    {
        $regNo = (string) $user->sl_reg_no;
        $centerId = (int) $user->sl_FK_of_center_id;

        return student_course_enrollment_rows($centerId, false)
            ->filter(fn ($row) => (string) $row->sl_reg_no === $regNo)
            ->map(function ($row) use ($regNo, $centerId) {
                $row->status = enrollment_status_for_course($regNo, $centerId, (int) $row->course_id);

                return $row;
            })
            ->values();
    }

    private function admitCardsByCourse($user)
    {
        $regNo = (string) $user->sl_reg_no;
        $centerId = (int) $user->sl_FK_of_center_id;
        $slIds = student_sl_ids_for_person($regNo, $centerId);

        return DB::table('student_admit_cards')
            ->where('center_id', $centerId)
            ->where(function ($query) use ($slIds, $regNo) {
                $query->whereIn('student_id', $slIds)->orWhere('reg_no', $regNo);
            })
            ->get()
            ->keyBy(fn ($row) => (int) $row->course_id);
    }

    private function admitOwnedByStudent(object $admit): bool
    {
        $user = Auth::guard('student')->user();
        $regNo = (string) $user->sl_reg_no;
        $centerId = (int) $user->sl_FK_of_center_id;
        $slIds = student_sl_ids_for_person($regNo, $centerId);

        if ((int) $admit->center_id !== $centerId) {
            return false;
        }

        if (in_array((int) $admit->student_id, $slIds, true)) {
            return true;
        }

        return trim((string) ($admit->reg_no ?? '')) === $regNo;
    }
}
