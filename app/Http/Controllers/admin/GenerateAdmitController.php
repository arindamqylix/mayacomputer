<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;

class GenerateAdmitController extends Controller
{
    public function generate_admit_card(){
        // Fetch ALL Students + Course + Center (Admin can see all students)
        // Exclude students who already have admit cards generated
        $students = DB::table('student_login')
            ->leftJoin('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->leftJoin('center_login', 'center_login.cl_id', '=', 'student_login.sl_FK_of_center_id')
            ->leftJoin('student_admit_cards', 'student_admit_cards.student_id', '=', 'student_login.sl_id')
            ->where('student_login.sl_status', 'VERIFIED') // Only verified students
            ->whereNull('student_admit_cards.ac_id') // Exclude students who already have admit cards
            ->select(
                'student_login.*',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_name as center_name',
                'center_login.cl_center_name'
            )
            ->orderBy('student_login.sl_id', 'DESC')
            ->get();

        // Fetch ALL Course List
        $courseList = DB::table('course')
            ->select('course.c_id', 'course.c_full_name', 'course.c_short_name')
            ->distinct()
            ->get();

        // Fetch all active centers for exam venue dropdown
        $activeCenters = DB::table('center_login')
            ->whereIn('cl_account_status', ['ACTIVE', 'APPROVED'])
            ->select('cl_id', 'cl_code', 'cl_center_name', 'cl_center_address')
            ->orderBy('cl_center_name', 'ASC')
            ->get();

        return view('admin.admit_card.create', compact('students', 'courseList', 'activeCenters'));
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

        $studentIds = $request->student_ids;
        $successCount = 0;
        $errorCount = 0;

        DB::beginTransaction();
        try {
            foreach ($studentIds as $studentId) {
                // Get student details - verify student exists and is VERIFIED
                $student = DB::table('student_login')
                    ->where('sl_id', $studentId)
                    ->where('sl_status', 'VERIFIED') // Ensure only verified students
                    ->select(
                        'sl_id',
                        'sl_reg_no',
                        'sl_FK_of_course_id',
                        'sl_FK_of_center_id'
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
                        'center_id'  => $student->sl_FK_of_center_id,
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

    public function admit_card_list(Request $request){
        // Admin can see ALL admit cards from ALL centers
        $centers = DB::table('center_login')->orderBy('cl_name', 'asc')->get();

        $query = DB::table('student_admit_cards AS a')
            ->join('student_login AS s', 's.sl_id', '=', 'a.student_id')
            ->join('course AS c', 'c.c_id', '=', 's.sl_FK_of_course_id')
            ->leftJoin('center_login AS cl', 'cl.cl_id', '=', 'a.center_id')
            ->select(
                'a.*',
                's.*',
                'c.c_full_name',
                'cl.cl_name as center_name'
            )
            ->orderBy('a.ac_id', 'DESC');

        if ($request->has('center_id') && !empty($request->center_id)) {
            $query->where('a.center_id', $request->center_id);
        }

        $admitCards = $query->get();
        $selectedCenterId = $request->center_id;

        return view('admin.admit_card.index', compact('admitCards', 'centers', 'selectedCenterId'));
    }

    public function edit_admit_card($id)
    {
        // Fetch Admit Card by ID
        $admit = DB::table('student_admit_cards')
            ->where('ac_id', $id)
            ->first();

        if (!$admit) {
            return back()->with('error', 'Admit Card not found');
        }

        // Fetch all students with course name (Admin can see all students)
        $students = DB::table('student_login')
            ->join('course', 'course.c_id', '=', 'student_login.sl_FK_of_course_id')
            ->leftJoin('center_login', 'center_login.cl_id', '=', 'student_login.sl_FK_of_center_id')
            ->select('student_login.*', 'course.c_full_name', 'center_login.cl_name as center_name')
            ->get();

        return view('admin.admit_card.edit', compact('admit', 'students'));
    }

    public function update_admit_card(Request $request, $id)
    {
        $request->validate([
            'reg_no' => 'required',
            'exam_date' => 'required|date',
            'exam_time' => 'required',
            'exam_venue' => 'required',
        ]);

        // Get student to get center_id
        $student = DB::table('student_login')
            ->where('sl_id', $request->reg_no)
            ->first();

        if (!$student) {
            return back()->with('error', 'Invalid student selected');
        }

        DB::table('student_admit_cards')->where('ac_id', $id)->update([
            'student_id'  => $request->reg_no,
            'center_id'   => $student->sl_FK_of_center_id,
            'exam_date'   => $request->exam_date,
            'exam_time'   => $request->exam_time,
            'exam_venue'  => $request->exam_venue,
            'exam_notice' => $request->exam_notice,
            'updated_at'  => now(),
        ]);

        return redirect()->route('admin.admit_card_list')->with('success', 'Admit Card Updated Successfully');
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

        return view('admin.admit_card.print', compact('admit', 'student', 'course', 'center'));
    }

    public function delete_admit_card($id)
    {
        try {
            $admit = DB::table('student_admit_cards')
                ->where('ac_id', $id)
                ->first();

            if (!$admit) {
                return back()->with('error', 'Admit Card not found');
            }

            DB::table('student_admit_cards')
                ->where('ac_id', $id)
                ->delete();

            return back()->with('success', 'Admit Card deleted successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting admit card: ' . $e->getMessage());
        }
    }
}

