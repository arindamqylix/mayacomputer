<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

use Barryvdh\DomPDF\Facade\Pdf as PDF;

class GenerateAdmitController extends Controller
{
    public function download_admit_card($id)
    {
        $data = admit_card_view_data($id);
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

    public function generate_admit_card()
    {
        $centerId = Auth::guard('center')->user()->cl_id;

        $students = admit_card_eligible_enrollments($centerId);

        $courseList = DB::table('course')
            ->join('student_login', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->select('course.c_id', 'course.c_full_name', 'course.c_short_name')
            ->distinct()
            ->orderBy('course.c_full_name', 'ASC')
            ->get();

        $activeCenters = DB::table('center_login')
            ->whereIn('cl_account_status', ['ACTIVE', 'APPROVED'])
            ->select('cl_id', 'cl_code', 'cl_center_name', 'cl_center_address')
            ->orderBy('cl_center_name', 'ASC')
            ->get();

        return view('center.admit_card.create', compact('students', 'courseList', 'activeCenters'));
    }

    public function handle_admit_card(Request $request)
    {
        $request->validate([
            'student_ids' => 'required|array|min:1',
            'student_ids.*' => 'required|integer|exists:student_login,sl_id',
            'exam_date' => 'required|date',
            'exam_time' => 'required',
            'exam_venue' => 'required|string',
            'exam_notice' => 'nullable|string',
        ]);

        $centerId = Auth::guard('center')->user()->cl_id;
        $successCount = 0;
        $errorCount = 0;

        DB::beginTransaction();
        try {
            foreach ($request->student_ids as $studentId) {
                $student = DB::table('student_login')
                    ->where('sl_id', $studentId)
                    ->where('sl_FK_of_center_id', $centerId)
                    ->select('sl_id', 'sl_reg_no', 'sl_FK_of_course_id', 'sl_FK_of_center_id')
                    ->first();

                if (!$student) {
                    $errorCount++;
                    continue;
                }

                $courseId = (int) $student->sl_FK_of_course_id;
                $status = enrollment_status_for_course((string) $student->sl_reg_no, $centerId, $courseId);

                if ($status !== 'VERIFIED') {
                    $errorCount++;
                    continue;
                }

                $existingAdmit = DB::table('student_admit_cards')
                    ->where('student_id', $student->sl_id)
                    ->where('course_id', $courseId)
                    ->first();

                if (!$existingAdmit) {
                    $existingAdmit = DB::table('student_admit_cards')
                        ->where('center_id', $centerId)
                        ->where('course_id', $courseId)
                        ->where('reg_no', $student->sl_reg_no)
                        ->first();
                }

                $payload = [
                    'exam_date' => $request->exam_date,
                    'exam_time' => $request->exam_time,
                    'exam_venue' => $request->exam_venue,
                    'exam_notice' => $request->exam_notice,
                    'updated_at' => now(),
                ];

                if ($existingAdmit) {
                    DB::table('student_admit_cards')
                        ->where('ac_id', $existingAdmit->ac_id)
                        ->update(array_merge($payload, [
                            'student_id' => $student->sl_id,
                            'course_id' => $courseId,
                            'reg_no' => $student->sl_reg_no,
                        ]));
                } else {
                    DB::table('student_admit_cards')->insert(array_merge($payload, [
                        'center_id' => $centerId,
                        'student_id' => $student->sl_id,
                        'course_id' => $courseId,
                        'reg_no' => $student->sl_reg_no,
                        'created_at' => now(),
                    ]));
                }

                $successCount++;
            }

            DB::commit();

            if ($successCount > 0) {
                $message = $successCount . ' Admit Card(s) Created Successfully!';
                if ($errorCount > 0) {
                    $message .= ' (' . $errorCount . ' failed)';
                }

                return back()->with('success', $message);
            }

            return back()->with('error', 'No admit cards were created. Please select valid verified enrollments.');
        } catch (\Exception $e) {
            DB::rollBack();

            return back()->with('error', 'Failed to create admit cards: ' . $e->getMessage());
        }
    }

    public function admit_card_list()
    {
        $center_id = Auth::guard('center')->user()->cl_id;

        $admitCards = DB::table('student_admit_cards AS a')
            ->join('student_login AS s', 's.sl_id', '=', 'a.student_id')
            ->join('course AS c', 'c.c_id', '=', DB::raw('COALESCE(NULLIF(a.course_id, 0), s.sl_FK_of_course_id)'))
            ->where('a.center_id', $center_id)
            ->select(
                'a.ac_id',
                'a.center_id',
                'a.student_id',
                'a.course_id',
                'a.reg_no',
                'a.exam_date',
                'a.exam_time',
                'a.exam_venue',
                'a.exam_notice',
                's.sl_reg_no',
                's.sl_name',
                's.sl_dob',
                's.sl_FK_of_center_id',
                'c.c_full_name',
                DB::raw("(SELECT MAX(sl_dob) FROM student_login p WHERE p.sl_reg_no = COALESCE(a.reg_no, s.sl_reg_no) AND p.sl_dob IS NOT NULL AND p.sl_dob != '' AND p.sl_dob != '0000-00-00') as profile_dob")
            )
            ->get()
            ->map(function ($row) {
                if (is_weak_student_field('sl_dob', $row->sl_dob ?? null) && !is_weak_student_field('sl_dob', $row->profile_dob ?? null)) {
                    $row->sl_dob = $row->profile_dob;
                }
                return enrich_admit_card_list_item($row);
            });

        return view('center.admit_card.index', compact('admitCards'));
    }


    public function edit_admit_card($id)
    {
        $center_id = Auth::guard('center')->user()->cl_id;

        // Fetch Admit Card by ID
        $admit = DB::table('student_admit_cards')
            ->where('ac_id', $id)
            ->first();


        // Fetch all students with course name
        $students = DB::table('student_login')
            ->join('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->where('student_login.sl_FK_of_center_id', $center_id)
            ->select('student_login.*', 'course.c_full_name')
            ->get();

        // Fetch all active centers for exam venue dropdown
        $activeCenters = DB::table('center_login')
            ->whereIn('cl_account_status', ['ACTIVE', 'APPROVED'])
            ->select('cl_id', 'cl_code', 'cl_center_name', 'cl_center_address')
            ->orderBy('cl_center_name', 'ASC')
            ->get();

        return view('center.admit_card.edit', compact('admit', 'students', 'activeCenters'));
    }


    public function update_admit_card(Request $request, $id)
    {
        $request->validate([
            'reg_no' => 'required',
            'exam_date' => 'required|date',
            'exam_time' => 'required',
            'exam_venue' => 'required',
        ]);

        DB::table('student_admit_cards')->where('ac_id', $id)->update([
            'student_id' => $request->reg_no,
            'exam_date' => $request->exam_date,
            'exam_time' => $request->exam_time,
            'exam_venue' => $request->exam_venue,
            'exam_notice' => $request->exam_notice,
        ]);

        return redirect()->route('admit_card_list')->with('success', 'Admit Card Updated Successfully');
    }

    public function print_admit_card($id)
    {
        $data = admit_card_view_data($id);
        if (!$data) {
            return back()->with('error', 'Admit Card not found');
        }

        return view('center.admit_card.print', $data);
    }

}
