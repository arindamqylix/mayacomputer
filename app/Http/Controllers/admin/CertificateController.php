<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use App\Models\admin\Course;
use App\Models\center\Certificate;
use App\Models\center\Student;
use Carbon\Carbon;

class CertificateController extends Controller
{
    /** Backfill missing course id on older certificate rows (center generate omitted this field). */
    private function backfillCertificateCourseIds(): void
    {
        $rows = DB::table('student_certificates')
            ->whereNull('sc_FK_of_course_id')
            ->select('sc_id', 'sc_FK_of_student_id', 'sc_FK_of_result_id')
            ->get();

        foreach ($rows as $row) {
            $courseId = null;
            if ($row->sc_FK_of_result_id) {
                $courseId = DB::table('set_result')
                    ->where('sr_id', $row->sc_FK_of_result_id)
                    ->value('sr_FK_of_course_id');
                if ((int) $courseId === 0) {
                    $courseId = null;
                }
            }
            if (! $courseId) {
                $courseId = DB::table('student_login')
                    ->where('sl_id', $row->sc_FK_of_student_id)
                    ->value('sl_FK_of_course_id');
            }
            if ($courseId) {
                DB::table('student_certificates')
                    ->where('sc_id', $row->sc_id)
                    ->update(['sc_FK_of_course_id' => $courseId]);
            }
        }
    }

    // List all certificates (admin panel)
    // Join course on certificate's course (sc_FK_of_course_id) so Typing certs show correct course
    public function certificate_list()
    {
        $this->backfillCertificateCourseIds();

        $certificates = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->leftJoin('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
            ->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                DB::raw('COALESCE(course.c_full_name, course_sl.c_full_name) as c_full_name'),
                DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name'),
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code'
            )
            ->orderBy('student_certificates.sc_id', 'DESC')
            ->get();

        return view('admin.certificate.index', compact('certificates'));
    }

    // Generate certificate page (admin panel)
    public function generate_certificate()
    {
        $this->backfillCertificateCourseIds();

        $courseIdSql = 'COALESCE(NULLIF(set_result.sr_FK_of_course_id, 0), student_login.sl_FK_of_course_id)';

        $regularCertExists = function ($query) use ($courseIdSql) {
            $query->select(DB::raw(1))
                ->from('student_certificates as sc')
                ->join('student_login as cert_sl', 'cert_sl.sl_id', '=', 'sc.sc_FK_of_student_id')
                ->whereColumn('cert_sl.sl_reg_no', 'student_login.sl_reg_no')
                ->whereColumn('cert_sl.sl_FK_of_center_id', 'set_result.sr_FK_of_center_id')
                ->where(function ($q) {
                    $q->where('sc.sc_type', 'REGULAR')->orWhereNull('sc.sc_type');
                })
                ->where(function ($q) use ($courseIdSql) {
                    $q->whereColumn('sc.sc_FK_of_result_id', 'set_result.sr_id')
                        ->orWhereRaw("sc.sc_FK_of_course_id = {$courseIdSql}");
                });
        };

        $baseResultQuery = function () use ($courseIdSql, $regularCertExists) {
            return DB::table('set_result')
                ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
                ->join('center_login', 'set_result.sr_FK_of_center_id', '=', 'center_login.cl_id')
                ->join('course', function ($join) use ($courseIdSql) {
                    $join->whereRaw("course.c_id = {$courseIdSql}");
                })
                ->whereNotIn('student_login.sl_status', ['PENDING', 'BLOCK'])
                ->where(function ($q) {
                    $q->whereNull('course.is_typing_related')
                        ->orWhere('course.is_typing_related', 0);
                });
        };

        // Students with a published result and no REGULAR certificate yet
        $students = $baseResultQuery()
            ->whereNotExists($regularCertExists)
            ->select(
                'student_login.sl_id',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'student_login.sl_photo',
                'course.c_id',
                'course.c_full_name',
                'course.c_short_name',
                'course.c_duration',
                'student_login.sl_reg_date',
                'student_login.sl_status',
                'set_result.sr_id as result_id',
                'set_result.sr_total_marks_obtained',
                'set_result.sr_percentage',
                'set_result.sr_grade',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();

        // Diagnostics for empty list
        $publishedResultCount = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->whereNotIn('student_login.sl_status', ['PENDING', 'BLOCK'])
            ->count();

        $alreadyCertifiedCount = $baseResultQuery()
            ->whereExists($regularCertExists)
            ->count();

        $typingBlockedCount = DB::table('set_result')
            ->join('student_login', 'set_result.sr_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', function ($join) use ($courseIdSql) {
                $join->whereRaw("course.c_id = {$courseIdSql}");
            })
            ->whereNotIn('student_login.sl_status', ['PENDING', 'BLOCK'])
            ->where('course.is_typing_related', 1)
            ->count();

        $missingResultCount = DB::table('student_login as s')
            ->join('course as c', 's.sl_FK_of_course_id', '=', 'c.c_id')
            ->where('s.sl_status', 'RESULT OUT')
            ->where(function ($q) {
                $q->whereNull('c.is_typing_related')
                    ->orWhere('c.is_typing_related', 0);
            })
            ->whereNotExists(function ($q) {
                $q->select(DB::raw(1))
                    ->from('set_result as r')
                    ->whereColumn('r.sr_FK_of_student_id', 's.sl_id')
                    ->where(function ($q2) {
                        $q2->whereColumn('r.sr_FK_of_course_id', 's.sl_FK_of_course_id')
                            ->orWhereNull('s.sl_FK_of_course_id');
                    });
            })
            ->count();

        $alreadyCertifiedStudents = DB::table('student_certificates as sc')
            ->join('student_login', 'sc.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->leftJoin('set_result', 'sc.sc_FK_of_result_id', '=', 'set_result.sr_id')
            ->leftJoin('course', 'sc.sc_FK_of_course_id', '=', 'course.c_id')
            ->leftJoin('course as course_sl', 'student_login.sl_FK_of_course_id', '=', 'course_sl.c_id')
            ->join('center_login', 'sc.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where(function ($q) {
                $q->where('sc.sc_type', 'REGULAR')->orWhereNull('sc.sc_type');
            })
            ->select(
                'sc.sc_id',
                'sc.sc_certificate_number',
                'sc.sc_issue_date',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                DB::raw('COALESCE(course.c_short_name, course_sl.c_short_name) as c_short_name'),
                'set_result.sr_percentage',
                'set_result.sr_grade',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('sc.sc_id', 'DESC')
            ->get();

        return view('admin.certificate.generate', compact(
            'students',
            'missingResultCount',
            'publishedResultCount',
            'alreadyCertifiedCount',
            'typingBlockedCount',
            'alreadyCertifiedStudents'
        ));
    }

    // Generate typing certificate page (admin panel)
    // Include students enrolled in Typing via sl_FK_of_course_id OR via student_enrollments
    // Typing course: category_name = 'Typing' OR course name contains 'Typing'
    public function generate_typing_certificate()
    {
        $students = typing_certificate_eligible_students();

        return view('admin.certificate.generate_typing', compact('students'));
    }

    // Generate certificate for a student (admin panel)
    public function generate_certificate_now(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer',
            'course_id' => 'required|integer',
            'issue_date' => 'required|date',
            'type' => 'required|in:REGULAR,TYPING',
        ]);

        if ($request->input('type') === 'TYPING') {
            $request->validate([
                'typing_speed_hindi' => 'required|numeric|min:1',
                'typing_speed_english' => 'required|numeric|min:1',
                'typing_accuracy' => 'required|numeric|min:1|max:100',
            ]);
        }

        $studentId = $request->input('student_id');
        $courseId = $request->input('course_id');
        $resultId = $request->input('result_id');
        $type = $request->input('type');
        $issueDate = $request->input('issue_date');

        // Check if certificate already exists for this course and type
        $student = Student::findOrFail($studentId);
        $personSlIds = student_sl_ids_for_person(
            (string) $student->sl_reg_no,
            (int) $student->sl_FK_of_center_id
        );

        $existingCertificateQuery = Certificate::where('sc_FK_of_course_id', $courseId)
            ->where('sc_type', $type)
            ->whereIn('sc_FK_of_student_id', $personSlIds);

        if ($type == 'REGULAR' && $resultId) {
            $existingCertificateQuery->where('sc_FK_of_result_id', $resultId);
        }

        if ($existingCertificateQuery->first()) {
            return back()->with('error', 'Certificate already generated for this student and course!');
        }

        if ($type === 'TYPING') {
            if (! Course::qualifiesForTypingCertificateById((int) $courseId)) {
                return back()->with('error', 'Selected course is not eligible for a typing certificate. Mark the course as typing-related or use the legacy typing category/name.');
            }
        } elseif (Course::isTypingRelated((int) $courseId)) {
            return back()->with('error', 'Regular certificates are not issued for typing-related courses. Use a typing certificate instead.');
        }

        // Generate certificate number (TYP0001, TYP0002, … — reuses gaps after delete)
        $prefix = $type == 'TYPING' ? 'TYP' : 'COD';
        $certificateNumber = next_certificate_number($prefix);

        $typingHindi = $type === 'TYPING' ? (string) $request->input('typing_speed_hindi') : null;
        $typingEnglish = $type === 'TYPING' ? (string) $request->input('typing_speed_english') : null;
        $typingSpeedSummary = ($type === 'TYPING' && ($typingHindi !== '' || $typingEnglish !== ''))
            ? 'Hindi: ' . $typingHindi . ' WPM, English: ' . $typingEnglish . ' WPM'
            : $request->input('typing_speed');

        // Create certificate
        $certificate = Certificate::create([
            'sc_FK_of_student_id' => $studentId,
            'sc_FK_of_center_id' => $student->sl_FK_of_center_id,
            'sc_FK_of_course_id' => $courseId,
            'sc_FK_of_result_id' => $resultId,
            'sc_certificate_number' => $certificateNumber,
            'sc_issue_date' => $issueDate,
            'sc_type' => $type,
            'sc_typing_speed' => $typingSpeedSummary,
            'sc_typing_speed_hindi' => $typingHindi,
            'sc_typing_speed_english' => $typingEnglish,
            'sc_typing_accuracy' => $request->input('typing_accuracy'),
            'sc_status' => 'GENERATED'
        ]);

        if ($certificate) {
            return redirect()->route('admin.certificate_list')->with('success', 'Certificate generated successfully!');
        } else {
            return back()->with('error', 'Failed to generate certificate!');
        }
    }

    // View certificate (admin panel)
    public function view_certificate($id)
    {
        $certificate_base = DB::table('student_certificates')->where('sc_id', $id)->first();
        if (!$certificate_base) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        $query = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_certificates.sc_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id);

        if ($certificate_base->sc_type == 'REGULAR') {
            $query->join('set_result', 'student_certificates.sc_FK_of_result_id', '=', 'set_result.sr_id')
                ->select(
                    'student_certificates.*',
                    'student_login.*',
                    'set_result.*',
                    'course.*',
                    'center_login.cl_center_name',
                    'center_login.cl_name',
                    'center_login.cl_code',
                    'center_login.cl_center_address',
                    'center_login.cl_authorized_signature',
                    'center_login.cl_center_stamp'
                );
        } else {
            $query->select(
                'student_certificates.*',
                'student_login.*',
                'course.*',
                'center_login.cl_center_name',
                'center_login.cl_name',
                'center_login.cl_code',
                'center_login.cl_center_address',
                'center_login.cl_authorized_signature',
                'center_login.cl_center_stamp'
            );
        }

        $certificate = $query->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate data missing!');
        }

        $setting = DB::table('site_settings')->first();

        if ($certificate->sc_type == 'TYPING') {
            return view('center.certificate.typing_view', compact('certificate', 'setting'));
        }

        return view('center.certificate.view', compact('certificate', 'setting'));
    }

    // Edit certificate (admin panel)
    public function edit_certificate($id)
    {
        $certificate = DB::table('student_certificates')
            ->join('student_login', 'student_certificates.sc_FK_of_student_id', '=', 'student_login.sl_id')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->join('center_login', 'student_certificates.sc_FK_of_center_id', '=', 'center_login.cl_id')
            ->where('student_certificates.sc_id', $id)
            ->select(
                'student_certificates.*',
                'student_login.sl_name',
                'student_login.sl_reg_no',
                'course.c_full_name',
                'center_login.cl_center_name'
            )
            ->first();

        if (!$certificate) {
            return redirect()->route('admin.certificate_list')->with('error', 'Certificate not found!');
        }

        return view('admin.certificate.edit', compact('certificate'));
    }

    // Update certificate (admin panel)
    public function update_certificate(Request $request, $id)
    {
        $request->validate([
            'certificate_number' => 'required|string|max:255',
            'issue_date' => 'required|date',
            'status' => 'required|string|in:GENERATED,ISSUED',
        ]);

        $certificate = Certificate::find($id);

        if (!$certificate) {
            return back()->with('error', 'Certificate not found!');
        }

        $certificate->update([
            'sc_certificate_number' => $request->certificate_number,
            'sc_issue_date' => $request->issue_date,
            'sc_status' => $request->status,
        ]);

        return redirect()->route('admin.certificate_list')->with('success', 'Certificate updated successfully!');
    }

    // Delete certificate (admin panel)
    public function delete_certificate($id)
    {
        try {
            $certificate = Certificate::find($id);

            if (!$certificate) {
                return back()->with('error', 'Certificate not found!');
            }

            // Delete the certificate
            $delete = Certificate::where('sc_id', $id)->delete();

            if ($delete):
                return back()->with('success', 'Certificate deleted successfully!');
            else:
                return back()->with('error', 'Something Went Wrong!');
            endif;
        } catch (\Exception $e) {
            return back()->with('error', 'Error deleting certificate: ' . $e->getMessage());
        }
    }
}

