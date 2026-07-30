<?php

namespace App\Http\Controllers\student;

use App\Http\Controllers\Controller;
use Auth;
use DB;

class RegistrationCardController extends Controller
{
    public function registration_list()
    {
        $user = Auth::guard('student')->user();
        $enrollments = $this->enrollmentsForStudent($user);

        if ($enrollments->isEmpty()) {
            return redirect()->route('student_dashboard')->with('error', 'Student information not found.');
        }

        return view('student.registration.list', compact('enrollments'));
    }

    public function view_registration_card($courseId)
    {
        $user = Auth::guard('student')->user();
        $courseId = (int) $courseId;
        $enrollments = $this->enrollmentsForStudent($user);
        $enrollment = $enrollments->first(fn ($row) => (int) $row->course_id === $courseId);

        if (!$enrollment) {
            return redirect()->route('view_registration_card')->with('error', 'Registration card not found for this course.');
        }

        $status = strtoupper((string) ($enrollment->status ?? 'PENDING'));
        if (in_array($status, ['PENDING', 'BLOCK'], true)) {
            return redirect()->route('view_registration_card')->with(
                'error',
                'Registration card for ' . ($enrollment->c_short_name ?? 'this course') . ' is not available until admin approval.'
            );
        }

        $data = DB::table('student_login')
            ->join('center_login', 'student_login.sl_FK_of_center_id', 'center_login.cl_id')
            ->where('student_login.sl_id', (int) $enrollment->sl_id)
            ->select(
                'student_login.*',
                'center_login.cl_name',
                'center_login.cl_center_name',
                'center_login.cl_code',
                'center_login.cl_center_address'
            )
            ->first();

        if (!$data) {
            return redirect()->route('view_registration_card')->with('error', 'Student information not found.');
        }

        $course = DB::table('course')->where('c_id', $courseId)->first();
        if ($course) {
            $data->c_id = $course->c_id;
            $data->c_full_name = $course->c_full_name;
            $data->c_short_name = $course->c_short_name;
            $data->c_duration = $course->c_duration;
        }

        $setting = DB::table('site_settings')->first();
        $student = $data;

        return view('student.view_registration_card', compact('data', 'setting', 'student'));
    }

    private function enrollmentsForStudent($user)
    {
        $regNo = (string) $user->sl_reg_no;
        $centerId = (int) $user->sl_FK_of_center_id;

        return student_course_enrollment_rows($centerId, null)
            ->filter(fn ($row) => (string) $row->sl_reg_no === $regNo)
            ->map(function ($row) use ($regNo, $centerId) {
                $row->status = enrollment_status_for_course($regNo, $centerId, (int) $row->course_id);

                return $row;
            })
            ->values();
    }
}
