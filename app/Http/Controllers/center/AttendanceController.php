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

            $status = $request->attd[$studentId] ?? 'ABSENT';

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
        $centerId = Auth::guard('center')->user()->cl_id;

        // 1. Fetch Batches for Dropdown
        $batches = DB::table('attendence_batch')
            ->where('ab_FK_of_center_id', $centerId)
            ->get();

        // 2. Get Filters (Defaults: Current Month/Year)
        $year    = $request->input('year', now()->year);
        $month   = $request->input('month', now()->month);
        $batchId = $request->input('batch_id');

        // 3. Generate Date Range for the selected Month
        $startDate = \Carbon\Carbon::create($year, $month, 1);
        $endDate   = $startDate->copy()->endOfMonth();

        $dates = [];
        $loop  = $startDate->copy();
        while ($loop <= $endDate) {
            $dates[] = $loop->toDateString();
            $loop->addDay();
        }

        // 4. Fetch Students based on filters
        $studentQuery = Student::where('sl_FK_of_center_id', $centerId);

        if ($batchId) {
            $studentQuery->join('attendence_set', 'attendence_set.as_FK_of_student_id', '=', 'student_login.sl_id')
                         ->where('attendence_set.as_FK_of_attendance_batch_id', $batchId);
        }

        $students = $studentQuery->select('student_login.*')->distinct()->get();

        // 5. Build Attendance Matrix
        $attendanceData = MarkAttendance::where('am_FK_of_center_id', $centerId)
            ->whereBetween('am_date', [$startDate->toDateString(), $endDate->toDateString()])
            ->get()
            ->groupBy('am_FK_of_student_id');

        $attendanceReport = [];

        foreach ($students as $student) {
            // Get this student's attendance records
            $studentAtts = $attendanceData->get($student->sl_id, collect());
            
            // Map by date => status
            $attMap = $studentAtts->pluck('am_status', 'am_date')->toArray();

            foreach ($dates as $date) {
                $status = $attMap[$date] ?? 'NONE';
                $attendanceReport[$student->sl_name][$date] = $status;
            }
        }

        return view('center.attendance.attndance_report', compact('attendanceReport', 'dates', 'batches', 'year', 'month', 'batchId'));
    }

}
