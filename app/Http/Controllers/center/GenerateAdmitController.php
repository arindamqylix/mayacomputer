<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class GenerateAdmitController extends Controller
{
    public function generate_admit_card(){
        $centerId = Auth::guard('center')->user()->cl_id;

        // Fetch only VERIFIED students + Course (Only approved students)
        // Exclude students who already have admit cards generated
        $students = DB::table('student_login')
            ->leftJoin('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->leftJoin('student_admit_cards', function($join) use ($centerId) {
                $join->on('student_admit_cards.student_id', '=', 'student_login.sl_id')
                     ->where('student_admit_cards.center_id', $centerId);
            })
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->where('student_login.sl_status', 'VERIFIED') // Only approved/verified students
            ->whereNull('student_admit_cards.ac_id') // Exclude students who already have admit cards
            ->select(
                'student_login.*',
                'course.c_full_name',
                'course.c_short_name'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();

        // Fetch Course List of this Center (only courses that have verified students)
        $courseList = DB::table('course')
            ->join('student_login', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->where('student_login.sl_status', 'VERIFIED') // Only courses with verified students
            ->select('course.c_id', 'course.c_full_name', 'course.c_short_name')
            ->distinct()
            ->orderBy('course.c_full_name', 'ASC')
            ->get();

        // Fetch all active centers for exam venue dropdown
        $activeCenters = DB::table('center_login')
            ->whereIn('cl_account_status', ['ACTIVE', 'APPROVED'])
            ->select('cl_id', 'cl_code', 'cl_center_name', 'cl_center_address')
            ->orderBy('cl_center_name', 'ASC')
            ->get();

        return view('center.admit_card.create', compact('students', 'courseList', 'activeCenters'));
    }

    public function handle_admit_card(Request $request){
        $request->validate([
            'student_ids'  => 'required|array|min:1',
            'student_ids.*'=> 'required|integer|exists:student_login,sl_id',
            'exam_date'    => 'required|date',
            'exam_time'    => 'required',
            'exam_venue'   => 'required|string',
            'exam_notice'  => 'nullable|string',
        ]);

        $centerId = Auth::guard('center')->user()->cl_id;
        $studentIds = $request->student_ids;
        $successCount = 0;
        $errorCount = 0;

        DB::beginTransaction();
        try {
            foreach ($studentIds as $studentId) {
                // Get student details - verify student belongs to this center and is VERIFIED
                $student = DB::table('student_login')
                    ->where('sl_id', $studentId)
                    ->where('sl_FK_of_center_id', $centerId)
                    ->where('sl_status', 'VERIFIED') // Ensure only verified students
                    ->select(
                        'sl_id',
                        'sl_reg_no',
                        'sl_FK_of_course_id'
                    )
                    ->first();

                if (!$student) {
                    $errorCount++;
                    continue;
                }

                // Check if admit card already exists for this student
                $existingAdmit = DB::table('student_admit_cards')
                    ->where('student_id', $student->sl_id)
                    ->first();

                if ($existingAdmit) {
                    // Update existing admit card
                    DB::table('student_admit_cards')
                        ->where('ac_id', $existingAdmit->ac_id)
                        ->update([
                            'exam_date'  => $request->exam_date,
                            'exam_time'  => $request->exam_time,
                            'exam_venue' => $request->exam_venue,
                            'exam_notice'=> $request->exam_notice,
                            'updated_at' => now(),
                        ]);
                } else {
                    // Insert new admit card
                    DB::table('student_admit_cards')->insert([
                        'center_id'  => $centerId,
                        'student_id' => $student->sl_id,
                        'course_id'  => $student->sl_FK_of_course_id,
                        'reg_no'     => $student->sl_reg_no,
                        'exam_date'  => $request->exam_date,
                        'exam_time'  => $request->exam_time,
                        'exam_venue' => $request->exam_venue,
                        'exam_notice'=> $request->exam_notice,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
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
            } else {
                return back()->with('error', 'No admit cards were created. Please select valid students.');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Failed to create admit cards: ' . $e->getMessage());
        }
    }

    public function admit_card_list(){
        $center_id = Auth::guard('center')->user()->cl_id;

        $admitCards = DB::table('student_admit_cards AS a')
            ->join('student_login AS s', 's.sl_id', '=', 'a.student_id')
            ->join('course AS c', 'c.c_id', '=', 's.sl_FK_of_course_id')
            ->where('a.center_id', $center_id)
            ->select(
                'a.*',
                's.*',
                'c.c_full_name'
            )
            ->get();

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
            'student_id'  => $request->reg_no,
            'exam_date'   => $request->exam_date,
            'exam_time'   => $request->exam_time,
            'exam_venue'  => $request->exam_venue,
            'exam_notice' => $request->exam_notice,
        ]);

        return redirect()->route('admit_card_list')->with('success', 'Admit Card Updated Successfully');
    }

    public function print_admit_card($id)
    {
        $admit = DB::table('student_admit_cards')
            ->where('ac_id', $id)
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

        return view('center.admit_card.print', compact('admit', 'student', 'course', 'center'));
    }

}
