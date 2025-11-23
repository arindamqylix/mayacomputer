<?php

namespace App\Http\Controllers\center;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\center\Attendance;
use App\Models\center\MarkAttendance;
use App\Models\center\Student;
use Auth;
use DB;
use Carbon\Carbon;
class AttendanceController extends Controller
{

    public function attndance_batch(){
    	$attndance_batch['attndance_batch'] = Attendance::all();
    	return view('center.attendance.create',$attndance_batch);
    }

    public function attndance_batch_create(Request $request){
    	$data = [
    		'ab_FK_of_center_id'		=> Auth::guard('center')->user()->cl_id,
    		'ab_name'					=> $request->batch_name,
    		'ab_start_time'				=> $request->start_time,
    		'ab_end_time'				=> $request->end_time,
    		'ab_status'					=> $request->status,
    	];

    	$insert = Attendance::create($data);
    	if($insert):
    		return back()->with('success', 'New Batch Added Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    public function attndance_batch_delete($id){
    	$data = Attendance::where('ab_id',$id)->delete();
    	if($data):
    		return back()->with('success', 'Batch Deleted Successfully!');
    	else:
    		return back()->with('error', 'Something Went Wrong!');
    	endif;
    }

    // Make Attendance
    public function make_attendance(Request $request)
    {
        $centerId = Auth::guard('center')->user()->cl_id;

        $batchId = $request->batch_id;
        $date    = $request->att_date;

        // Fetch all batches of this center (DB Only)
        $batch = DB::table('attendence_batch')
            ->where('ab_FK_of_center_id', $centerId)
            ->get();

        $students = collect();
        $marked   = collect();

        if ($batchId && $date) {

            // Fetch students assigned to this batch
            $students = DB::table('attendence_set')
                ->join('student_login', 'student_login.sl_id', '=', 'attendence_set.as_FK_of_student_id')
                ->where('attendence_set.as_FK_of_attendance_batch_id', $batchId)
                ->select(
                    'student_login.sl_id',
                    'student_login.sl_name',
                    'student_login.sl_reg_no'
                )
                ->get();

            // Already marked attendance for this date and batch
            $marked = DB::table('attendance_mark')
                ->where('am_FK_of_batch_id', $batchId)
                ->where('am_date', $date)
                ->pluck('am_status', 'am_FK_of_student_id');  
        }

        return view('center.attendance.make_attendance', compact('batch','students','marked'));
    }


    public function save_attendance(Request $request)
    {
        $request->validate([
            'batch_id' => 'required',
            'att_date' => 'required|date',
        ]);

        $centerId = Auth::guard('center')->user()->cl_id;
        $batchId  = $request->batch_id;
        $date     = $request->att_date;

        foreach ($request->student_id as $studentId) {

            $status = isset($request->attd[$studentId]) ? 'PRESENT' : 'ABSENT';

            MarkAttendance::updateOrCreate(
                [
                    'am_FK_of_student_id' => $studentId,
                    'am_FK_of_batch_id'   => $batchId,
                    'am_FK_of_center_id'  => $centerId,
                    'am_date'             => $date,
                ],
                [
                    'am_status' => $status
                ]
            );
        }

        return back()->with('success', 'Attendance Saved Successfully!');
    }



    public function mark_attendance(Request $request){
        // dd(request()->get('batch_id'));
        $validatedData = $request->validate([
            'attd.*' => 'required|boolean', // Assuming the value of each checkbox is a boolean
        ]);

        foreach ($validatedData['attd'] as $studentId => $present) {
            // Check if attendance already exists for the student on the current date
            $existingAttendance = MarkAttendance::where('am_FK_of_student_id', $studentId)
                ->where('am_date', now()->toDateString())
                ->exists();

            if (!$existingAttendance) {
                $attendance = new MarkAttendance();
                $attendance->am_FK_of_batch_id = request()->get('batch_id');
                $attendance->am_FK_of_center_id = Auth::guard('center')->user()->cl_id;
                $attendance->am_FK_of_student_id = $studentId;
                $attendance->am_date = now()->toDateString();
                $attendance->am_status = 'PRESENT';
                $attendance->save();
            }
        }

        return redirect()->back()->with('success', 'Attendance marked successfully');
    }

    public function attendance_report(Request $request)
    {
        $batch = Attendance::all();

        // Month selection
        $monthTable = $request->tbl_name; // e.g. jan_2024
        $monthMap = [
            'jan_2024' => [1, 2024],
            'feb_2024' => [2, 2024],
            'mar_2024' => [3, 2024],
            'apr_2024' => [4, 2024],
            'may_2024' => [5, 2024],
            'jun_2024' => [6, 2024],
            'jul_2024' => [7, 2024],
            'aug_2024' => [8, 2024],
            'sep_2024' => [9, 2024],
            'oct_2024' => [10, 2024],
            'nov_2024' => [11, 2024],
            'dec_2024' => [12, 2024],
        ];

        // Default → current month
        if ($monthTable && isset($monthMap[$monthTable])) {
            [$month, $year] = $monthMap[$monthTable];
        } else {
            $month = now()->month;
            $year = now()->year;
        }

        // Create date range
        $startDate = Carbon::create($year, $month, 1);
        $endDate   = $startDate->copy()->endOfMonth();

        // Prepare dates array
        $dates = [];
        $loop = $startDate->copy();
        while ($loop <= $endDate) {
            $dates[] = $loop->toDateString();
            $loop->addDay();
        }

        // Fetch students
        $students = Student::where('sl_FK_of_center_id', Auth::guard('center')->user()->cl_id)->get();

        // Prepare Attendance
        $attendanceReport = [];
        foreach ($students as $student) {

            $attendance = MarkAttendance::select('am_date', 'am_status')
                ->where('am_FK_of_student_id', $student->sl_id)
                ->where('am_FK_of_center_id', Auth::guard('center')->user()->cl_id)
                ->whereBetween('am_date', [$startDate, $endDate])
                ->get()
                ->groupBy('am_date')
                ->map(fn($dayGroup) => $dayGroup->max('am_status'));

            foreach ($dates as $date) {
                $attendanceReport[$student->sl_name][$date] = $attendance[$date] ?? 'No';
            }
        }

        return view('center.attendance.attndance_report', compact('attendanceReport', 'dates', 'batch', 'month', 'year'));
    }

}
