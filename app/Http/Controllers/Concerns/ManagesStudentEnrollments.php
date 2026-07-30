<?php

namespace App\Http\Controllers\Concerns;

use App\Models\admin\Course;
use App\Models\center\Center;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;

trait ManagesStudentEnrollments
{
    abstract protected function enrollmentsViewName(): string;

    abstract protected function enrollmentsListRoute(): string;

    abstract protected function enrollmentsManageRoute(int $studentId): string;

    abstract protected function enrollmentsAddRoute(int $studentId): string;

    abstract protected function enrollmentsRemoveRoute(int $studentId, int $courseId): string;

    abstract protected function enrollmentsStatusRoute(int $studentId): string;

    abstract protected function enrollmentsEditRoute(int $studentId): string;

    /**
     * Return false to abort with redirect (center ownership check).
     */
    abstract protected function authorizeEnrollmentAccess(object $student): bool;

    public function student_courses($id)
    {
        $student = DB::table('student_login')->where('sl_id', $id)->first();
        if (!$student || !$this->authorizeEnrollmentAccess($student)) {
            return redirect()->route($this->enrollmentsListRoute())->with('error', 'Student not found.');
        }

        $center = DB::table('center_login')->where('cl_id', $student->sl_FK_of_center_id)->first();
        $enrollments = $this->getStudentEnrollmentsList((string) $student->sl_reg_no, (int) $student->sl_FK_of_center_id);
        $enrolledCourseIds = $enrollments->pluck('course_id')->map(fn ($cid) => (int) $cid)->all();
        $availableCourses = Course::orderBy('c_short_name')
            ->get()
            ->filter(fn ($course) => !in_array((int) $course->c_id, $enrolledCourseIds, true))
            ->values();

        return view($this->enrollmentsViewName(), [
            'student' => $student,
            'center' => $center,
            'enrollments' => $enrollments,
            'availableCourses' => $availableCourses,
            'coursesManageRoute' => fn (int $sid) => $this->enrollmentsManageRoute($sid),
            'coursesAddRoute' => fn (int $sid) => $this->enrollmentsAddRoute($sid),
            'coursesRemoveRoute' => fn (int $sid, int $cid) => $this->enrollmentsRemoveRoute($sid, $cid),
            'coursesStatusRoute' => fn (int $sid) => $this->enrollmentsStatusRoute($sid),
            'coursesEditRoute' => fn (int $sid) => $this->enrollmentsEditRoute($sid),
            'coursesListRoute' => $this->enrollmentsListRoute(),
        ]);
    }

    public function add_student_course(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|integer',
        ]);

        $studentRow = DB::table('student_login')->where('sl_id', $id)->first();
        if (!$studentRow || !$this->authorizeEnrollmentAccess($studentRow)) {
            return redirect()->route($this->enrollmentsListRoute())->with('error', 'Student not found.');
        }

        $student = \App\Models\center\Student::findOrFail($id);
        $courseId = (int) $request->input('course_id');
        $course = Course::find($courseId);

        if (!$course) {
            return back()->with('error', 'Course not found.');
        }

        $regNo = $student->sl_reg_no;
        $centerId = (int) $student->sl_FK_of_center_id;
        $existing = $this->getStudentEnrollmentsList($regNo, $centerId);

        if ($existing->contains(fn ($row) => (int) $row->course_id === $courseId)) {
            return back()->with('error', 'Student is already enrolled in this course.');
        }

        $center = Center::findOrFail($centerId);
        if ($center->cl_wallet_balance < $course->c_price) {
            return back()->with('error', 'Center wallet balance is low. Please recharge before adding a course.');
        }

        DB::beginTransaction();
        try {
            $this->attachCourseToStudent($student, $courseId, $center);
            DB::commit();

            return redirect($this->enrollmentsManageRoute((int) $id))
                ->with('success', 'Course "' . $course->c_short_name . '" added successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('add_student_course error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Failed to add course. Please try again.');
        }
    }

    public function remove_student_course($id, $courseId)
    {
        $student = DB::table('student_login')->where('sl_id', $id)->first();
        if (!$student || !$this->authorizeEnrollmentAccess($student)) {
            return redirect()->route($this->enrollmentsListRoute())->with('error', 'Student not found.');
        }

        $courseId = (int) $courseId;
        $enrollments = $this->getStudentEnrollmentsList((string) $student->sl_reg_no, (int) $student->sl_FK_of_center_id);

        if (!$enrollments->contains(fn ($row) => (int) $row->course_id === $courseId)) {
            return back()->with('error', 'This course is not enrolled for this student.');
        }

        if ($enrollments->count() <= 1) {
            return back()->with('error', 'Cannot remove the last course. Delete the student instead if needed.');
        }

        DB::beginTransaction();
        try {
            $this->detachCourseFromStudent($student, $courseId);
            DB::commit();

            $redirectId = DB::table('student_login')
                ->where('sl_reg_no', $student->sl_reg_no)
                ->where('sl_FK_of_center_id', $student->sl_FK_of_center_id)
                ->orderBy('sl_id')
                ->value('sl_id');

            return redirect($this->enrollmentsManageRoute((int) ($redirectId ?: $id)))
                ->with('success', 'Course removed successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('remove_student_course error: ' . $e->getMessage(), ['trace' => $e->getTraceAsString()]);

            return back()->with('error', 'Failed to remove course. Please try again.');
        }
    }

    public function update_enrollment_status(Request $request, $id)
    {
        $request->validate([
            'course_id' => 'required|integer',
            'status' => 'required|in:PENDING,VERIFIED,RESULT UPDATED,RESULT OUT,DISPATCHED,BLOCK',
        ]);

        $student = DB::table('student_login')->where('sl_id', $id)->first();
        if (!$student || !$this->authorizeEnrollmentAccess($student)) {
            return response()->json(['msg' => 'Student not found.', 'status' => 0]);
        }

        if ($request->status === 'RESULT OUT') {
            $loginRow = DB::table('student_login')
                ->where('sl_reg_no', $student->sl_reg_no)
                ->where('sl_FK_of_center_id', $student->sl_FK_of_center_id)
                ->where('sl_FK_of_course_id', (int) $request->course_id)
                ->first();
            $resultSlId = $loginRow ? (int) $loginRow->sl_id : (int) $student->sl_id;

            $hasResult = DB::table('set_result')
                ->where('sr_FK_of_student_id', $resultSlId)
                ->where('sr_FK_of_course_id', (int) $request->course_id)
                ->exists();

            if (!$hasResult) {
                return response()->json([
                    'msg' => 'Publish the result for this course first (Result → Set Result).',
                    'status' => 0,
                ]);
            }
        }

        $courseId = (int) $request->course_id;
        $centerId = (int) $student->sl_FK_of_center_id;
        $status = $request->status;

        DB::table('student_login')
            ->where('sl_reg_no', $student->sl_reg_no)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->update(['sl_status' => $status, 'updated_at' => now()]);

        $slIds = DB::table('student_login')
            ->where('sl_reg_no', $student->sl_reg_no)
            ->where('sl_FK_of_center_id', $centerId)
            ->pluck('sl_id');

        DB::table('student_enrollments')
            ->where('se_FK_of_center_id', $centerId)
            ->where('se_FK_of_course_id', $courseId)
            ->whereIn('se_FK_of_student_id', $slIds)
            ->update(['se_status' => $status, 'updated_at' => now()]);

        return response()->json([
            'msg' => 'Course status updated successfully.',
            'status' => 1,
        ]);
    }

    protected function getStudentEnrollmentsList(string $regNo, int $centerId): \Illuminate\Support\Collection
    {
        $loginRows = DB::table('student_login as s')
            ->join('course as c', 's.sl_FK_of_course_id', '=', 'c.c_id')
            ->where('s.sl_reg_no', $regNo)
            ->where('s.sl_FK_of_center_id', $centerId)
            ->whereNotNull('s.sl_FK_of_course_id')
            ->select(
                's.sl_id',
                'c.c_id as course_id',
                'c.c_short_name',
                'c.c_full_name',
                'c.c_duration',
                'c.c_price',
                DB::raw('COALESCE(s.sl_status, "PENDING") as status'),
                's.sl_reg_date as enrolled_at',
                DB::raw('"login" as source')
            )
            ->get();

        $courseIdsFromLogin = $loginRows->pluck('course_id')->map(fn ($cid) => (int) $cid);

        $slIds = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->pluck('sl_id');

        $enrollmentOnly = collect();
        if ($slIds->isNotEmpty()) {
            $enrollmentOnly = DB::table('student_enrollments as se')
                ->join('course as c', 'se.se_FK_of_course_id', '=', 'c.c_id')
                ->where('se.se_FK_of_center_id', $centerId)
                ->whereIn('se.se_FK_of_student_id', $slIds)
                ->when($courseIdsFromLogin->isNotEmpty(), function ($query) use ($courseIdsFromLogin) {
                    $query->whereNotIn('se.se_FK_of_course_id', $courseIdsFromLogin);
                })
                ->select(
                    'se.se_FK_of_student_id as sl_id',
                    'se.se_id',
                    'c.c_id as course_id',
                    'c.c_short_name',
                    'c.c_full_name',
                    'c.c_duration',
                    'c.c_price',
                    DB::raw('COALESCE(se.se_status, "PENDING") as status'),
                    'se.created_at as enrolled_at',
                    DB::raw('"enrollment" as source')
                )
                ->get();
        }

        return $loginRows->concat($enrollmentOnly)->sortBy('c_short_name')->values();
    }

    protected function attachCourseToStudent(\App\Models\center\Student $student, int $courseId, Center $center): void
    {
        $regNo = $student->sl_reg_no;
        $centerId = (int) $student->sl_FK_of_center_id;
        $course = Course::findOrFail($courseId);

        $existingLoginRow = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->first();

        if (!$existingLoginRow) {
            $template = DB::table('student_login')->where('sl_id', $student->sl_id)->first();
            DB::table('student_login')->insert([
                'sl_FK_of_course_id' => $courseId,
                'sl_FK_of_center_id' => $centerId,
                'sl_dob' => $template->sl_dob,
                'sl_qualification' => $template->sl_qualification,
                'sl_reg_no' => $regNo,
                'sl_sex' => $template->sl_sex,
                'sl_address' => $template->sl_address,
                'sl_name' => $template->sl_name,
                'sl_photo' => $template->sl_photo,
                'sl_id_card' => $template->sl_id_card,
                'sl_mother_name' => $template->sl_mother_name,
                'sl_mobile_no' => $template->sl_mobile_no,
                'password' => $template->password,
                'sl_father_name' => $template->sl_father_name,
                'sl_educational_certificate' => $template->sl_educational_certificate,
                'sl_signature' => $template->sl_signature,
                'sl_email' => $template->sl_email,
                'sl_reg_date' => now()->toDateString(),
                'sl_status' => 'VERIFIED',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $primarySlId = (int) $student->sl_id;
        $exists = DB::table('student_enrollments')
            ->where('se_FK_of_student_id', $primarySlId)
            ->where('se_FK_of_course_id', $courseId)
            ->where('se_FK_of_center_id', $centerId)
            ->exists();

        if (!$exists) {
            DB::table('student_enrollments')->insert([
                'se_FK_of_student_id' => $primarySlId,
                'se_FK_of_course_id' => $courseId,
                'se_FK_of_center_id' => $centerId,
                'se_status' => 'VERIFIED',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        DB::table('transaction')->insert([
            't_student_reg_no' => $regNo,
            't_FK_of_center_id' => $centerId,
            't_amount' => $course->c_price,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        Center::where('cl_id', $centerId)->update([
            'cl_wallet_balance' => $center->cl_wallet_balance - $course->c_price,
        ]);
    }

    protected function detachCourseFromStudent(object $student, int $courseId): void
    {
        $regNo = $student->sl_reg_no;
        $centerId = (int) $student->sl_FK_of_center_id;

        $loginRow = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->first();

        $allLoginCount = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->count();

        $slIds = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->pluck('sl_id');

        DB::table('student_enrollments')
            ->where('se_FK_of_center_id', $centerId)
            ->where('se_FK_of_course_id', $courseId)
            ->whereIn('se_FK_of_student_id', $slIds)
            ->delete();

        if ($loginRow && $allLoginCount > 1) {
            $this->deleteEnrollmentDependencies((int) $loginRow->sl_id);

            return;
        }

        $primarySlId = (int) DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->orderBy('sl_id')
            ->value('sl_id');

        $this->deleteCourseSpecificRecords($primarySlId, $courseId);

        if ($loginRow && (int) $loginRow->sl_id === $primarySlId) {
            $remainingCourseId = DB::table('student_enrollments')
                ->where('se_FK_of_center_id', $centerId)
                ->where('se_FK_of_student_id', $primarySlId)
                ->orderBy('se_id')
                ->value('se_FK_of_course_id');

            if (!$remainingCourseId) {
                $remainingCourseId = DB::table('student_login')
                    ->where('sl_reg_no', $regNo)
                    ->where('sl_FK_of_center_id', $centerId)
                    ->where('sl_FK_of_course_id', '!=', $courseId)
                    ->whereNotNull('sl_FK_of_course_id')
                    ->orderBy('sl_id')
                    ->value('sl_FK_of_course_id');
            }

            if ($remainingCourseId) {
                DB::table('student_login')
                    ->where('sl_id', $primarySlId)
                    ->update(['sl_FK_of_course_id' => $remainingCourseId, 'updated_at' => now()]);
            }
        }
    }

    protected function deleteCourseSpecificRecords(int $slId, int $courseId): void
    {
        DB::table('set_result')
            ->where('sr_FK_of_student_id', $slId)
            ->where('sr_FK_of_course_id', $courseId)
            ->delete();
        DB::table('student_certificates')
            ->where('sc_FK_of_student_id', $slId)
            ->where('sc_FK_of_course_id', $courseId)
            ->delete();
        DB::table('student_admit_cards')
            ->where('student_id', $slId)
            ->where('course_id', $courseId)
            ->delete();
    }

    protected function deleteEnrollmentDependencies(int $slId): void
    {
        DB::table('set_result')->where('sr_FK_of_student_id', $slId)->delete();
        DB::table('student_certificates')->where('sc_FK_of_student_id', $slId)->delete();
        DB::table('set_fee')->where('sf_FK_of_student_id', $slId)->delete();
        DB::table('fees_payment')->where('fp_FK_of_student_id', $slId)->delete();
        DB::table('student_admit_cards')->where('student_id', $slId)->delete();
        DB::table('student_enrollments')->where('se_FK_of_student_id', $slId)->delete();

        if (Schema::hasTable('attendance_mark')) {
            DB::table('attendance_mark')->where('am_FK_of_student_id', $slId)->delete();
        }
        if (Schema::hasTable('attendence_set')) {
            DB::table('attendence_set')->where('as_FK_of_student_id', $slId)->delete();
        }
        if (Schema::hasTable('document_reissue_requests')) {
            DB::table('document_reissue_requests')->where('drr_FK_of_student_id', $slId)->delete();
        }

        DB::table('student_login')->where('sl_id', $slId)->delete();
    }
}
