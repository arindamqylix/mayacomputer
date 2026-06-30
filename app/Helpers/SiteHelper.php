<?php

use Illuminate\Support\Facades\DB;

if (!function_exists('site_settings')) {
    function site_settings() {
        return DB::table('site_settings')->where('id', 1)->first();
    }
}

if (!function_exists('breadcrumb_image')) {
    function breadcrumb_image() {
        $data = site_settings();
        return $data ? asset($data->breadcumb_image) : '';
    }
}

if (!function_exists('getFinancialYear')) {
    /**
     * Get current financial year in format YYYY-YY
     * Financial year runs from April to March
     * Example: April 2025 to March 2026 = 2025-26
     */
    function getFinancialYear($date = null) {
        if ($date === null) {
            $date = now();
        } elseif (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }
        
        $year = $date->year;
        $month = $date->month;
        
        // If month is April (4) or later, financial year starts this year
        // If month is January-March (1-3), financial year started last year
        if ($month >= 4) {
            $fyStart = $year;
            $fyEnd = $year + 1;
        } else {
            $fyStart = $year - 1;
            $fyEnd = $year;
        }
        
        // Format: 2025-26
        $fyEndShort = substr($fyEnd, -2);
        return $fyStart . '-' . $fyEndShort;
    }
}

if (!function_exists('generateInvoiceNumber')) {
    /**
     * Generate invoice number in format: MCC/YYYY-YY/NN
     * Example: MCC/2025-26/01
     * 
     * @param string $table Table name to check for existing invoices
     * @param string $dateColumn Column name for date (default: 'created_at')
     * @param string $invoiceColumn Column name for invoice number (default: 'invoice_no')
     * @param \Carbon\Carbon|null $date Date to use for financial year (default: now)
     * @return string Invoice number
     */
    function generateInvoiceNumber($table = 'center_recharge', $dateColumn = 'created_at', $invoiceColumn = 'invoice_no', $date = null) {
        if ($date === null) {
            $date = now();
        } elseif (is_string($date)) {
            $date = \Carbon\Carbon::parse($date);
        }
        
        $financialYear = getFinancialYear($date);
        
        // Get the last invoice number for this financial year
        $lastInvoice = DB::table($table)
            ->where($invoiceColumn, 'like', 'MCC/' . $financialYear . '/%')
            ->orderBy($invoiceColumn, 'desc')
            ->first();
        
        if ($lastInvoice && !empty($lastInvoice->$invoiceColumn)) {
            // Extract the sequential number from last invoice
            // Format: MCC/2025-26/01
            $parts = explode('/', $lastInvoice->$invoiceColumn);
            if (count($parts) === 3) {
                $lastNumber = (int) $parts[2];
                $nextNumber = $lastNumber + 1;
            } else {
                $nextNumber = 1;
            }
        } else {
            // First invoice for this financial year
            $nextNumber = 1;
        }
        
        // Format: MCC/2025-26/01
        $invoiceNumber = 'MCC/' . $financialYear . '/' . str_pad($nextNumber, 2, '0', STR_PAD_LEFT);
        
        return $invoiceNumber;
    }
}

if (!function_exists('format_dob_display')) {
    /**
     * Display date of birth in ordinal form, e.g. 15th Oct, 2001
     */
    function format_dob_display($date, $default = 'N/A') {
        if ($date === null || $date === '' || $date === '0000-00-00' || $date === '0000-00-00 00:00:00') {
            return $default;
        }
        try {
            $d = \Carbon\Carbon::parse($date);
        } catch (\Exception $e) {
            return is_string($date) ? $date : $default;
        }
        $day = (int) $d->format('j');
        if (in_array($day % 100, [11, 12, 13], true)) {
            $suffix = 'th';
        } else {
            $suffix = [1 => 'st', 2 => 'nd', 3 => 'rd'][$day % 10] ?? 'th';
        }
        return $day . $suffix . ' ' . $d->format('M') . ', ' . $d->format('Y');
    }
}

if (!function_exists('student_media_public_path')) {
    /**
     * Resolve a student photo/signature path to an existing file under public/.
     */
    function student_media_public_path($relativePath) {
        if ($relativePath === null || trim((string) $relativePath) === '') {
            return null;
        }

        $relative = ltrim(str_replace('\\', '/', (string) $relativePath), '/');
        $candidates = [$relative];
        if (strpos($relative, 'storage/') !== 0) {
            $candidates[] = 'storage/' . $relative;
        }

        foreach ($candidates as $path) {
            $full = public_path($path);
            if (is_file($full)) {
                return $full;
            }
        }

        return null;
    }
}

if (!function_exists('student_media_url')) {
    /**
     * Public URL for a student photo/signature when the file exists.
     */
    function student_media_url($relativePath) {
        $full = student_media_public_path($relativePath);
        if (!$full) {
            return null;
        }

        $relative = ltrim(str_replace('\\', '/', (string) $relativePath), '/');
        if (is_file(public_path($relative))) {
            return asset($relative);
        }

        return asset('storage/' . $relative);
    }
}

if (!function_exists('is_weak_student_field')) {
    function is_weak_student_field($field, $value) {
        if ($value === null) {
            return true;
        }

        $value = trim((string) $value);
        if ($value === '' || in_array(strtolower($value), ['student', 'n/a', '0000-00-00', '0000-00-00 00:00:00'], true)) {
            return true;
        }

        if ($field === 'sl_dob') {
            try {
                \Carbon\Carbon::parse($value);
                return false;
            } catch (\Exception $e) {
                return true;
            }
        }

        return false;
    }
}

if (!function_exists('resolve_student_profile_by_reg_no')) {
    /**
     * Best profile fields from all student_login rows sharing a registration number.
     */
    function resolve_student_profile_by_reg_no($regNo) {
        $regNo = trim((string) $regNo);
        if ($regNo === '') {
            return null;
        }

        $rows = DB::table('student_login')->where('sl_reg_no', $regNo)->get();
        if ($rows->isEmpty()) {
            return null;
        }

        $profileFields = [
            'sl_name', 'sl_father_name', 'sl_mother_name', 'sl_dob', 'sl_sex',
            'sl_category', 'sl_address', 'sl_photo', 'sl_signature', 'sl_mobile_no', 'sl_email',
        ];

        $profile = new \stdClass();
        foreach ($profileFields as $field) {
            $profile->$field = null;
            foreach ($rows as $row) {
                $value = $row->$field ?? null;
                if (!is_weak_student_field($field, $value)) {
                    $profile->$field = $value;
                    break;
                }
            }
        }

        return $profile;
    }
}

if (!function_exists('resolve_center_for_admit')) {
    /**
     * Resolve center for an admit card when center_id is missing or zero.
     */
    function resolve_center_for_admit($admitOrRow) {
        $centerId = (int) ($admitOrRow->center_id ?? 0);
        if ($centerId > 0) {
            $center = DB::table('center_login')->where('cl_id', $centerId)->first();
            if ($center) {
                return $center;
            }
        }

        $studentCenterId = (int) ($admitOrRow->sl_FK_of_center_id ?? 0);
        if ($studentCenterId > 0) {
            $center = DB::table('center_login')->where('cl_id', $studentCenterId)->first();
            if ($center) {
                return $center;
            }
        }

        $regNo = trim((string) ($admitOrRow->reg_no ?? $admitOrRow->sl_reg_no ?? ''));
        if ($regNo !== '') {
            $center = DB::table('center_login')
                ->whereRaw('? LIKE CONCAT(cl_code, "%")', [$regNo])
                ->orderByRaw('LENGTH(cl_code) DESC')
                ->first();
            if ($center) {
                return $center;
            }
        }

        $venue = trim((string) ($admitOrRow->exam_venue ?? ''));
        if ($venue !== '') {
            $center = DB::table('center_login')
                ->where(function ($q) use ($venue) {
                    $q->where('cl_center_name', $venue)
                        ->orWhere('cl_name', $venue);
                })
                ->first();
            if ($center) {
                return $center;
            }

            $center = DB::table('center_login')
                ->where(function ($q) use ($venue) {
                    $q->where('cl_center_name', 'like', '%' . $venue . '%')
                        ->orWhere('cl_name', 'like', '%' . $venue . '%');
                })
                ->first();
            if ($center) {
                return $center;
            }
        }

        return null;
    }
}

if (!function_exists('resolve_admit_center_id')) {
    function resolve_admit_center_id($student, $examVenue = null) {
        $centerId = (int) ($student->sl_FK_of_center_id ?? 0);
        if ($centerId > 0) {
            return $centerId;
        }

        $center = resolve_center_for_admit((object) [
            'reg_no' => $student->sl_reg_no ?? null,
            'sl_reg_no' => $student->sl_reg_no ?? null,
            'exam_venue' => $examVenue,
        ]);

        return $center ? (int) $center->cl_id : 0;
    }
}

if (!function_exists('resolve_admit_card_student')) {
    /**
     * Merge the best available student profile for an admit card (handles multi-course rows).
     */
    function resolve_admit_card_student($admit) {
        $student = DB::table('student_login')->where('sl_id', $admit->student_id)->first();
        if (!$student) {
            return null;
        }

        $regNo = trim((string) ($admit->reg_no ?? $student->sl_reg_no ?? ''));
        $centerId = (int) ($admit->center_id ?? $student->sl_FK_of_center_id ?? 0);
        if ($regNo === '') {
            return $student;
        }

        $rowsQuery = DB::table('student_login')->where('sl_reg_no', $regNo);
        if ($centerId > 0) {
            $rowsQuery->where('sl_FK_of_center_id', $centerId);
        }
        $rows = $rowsQuery->get();

        if ($rows->count() <= 1) {
            $only = $rows->first();
            if ($only && (int) $only->sl_id !== (int) $student->sl_id) {
                $student = $only;
            }

            $profileFields = [
                'sl_name', 'sl_father_name', 'sl_mother_name', 'sl_dob', 'sl_sex',
                'sl_category', 'sl_address', 'sl_photo', 'sl_signature', 'sl_mobile_no', 'sl_email',
            ];
            $merged = clone $student;
            foreach ($profileFields as $field) {
                if (!is_weak_student_field($field, $merged->$field ?? null)) {
                    continue;
                }
                foreach ($rows as $row) {
                    $value = $row->$field ?? null;
                    if (!is_weak_student_field($field, $value)) {
                        $merged->$field = $value;
                        break;
                    }
                }
            }
            if (empty($merged->sl_reg_no)) {
                $merged->sl_reg_no = $regNo;
            }

            $profile = resolve_student_profile_by_reg_no($regNo);
            if ($profile) {
                foreach ($profileFields as $field) {
                    if (is_weak_student_field($field, $merged->$field ?? null) && !is_weak_student_field($field, $profile->$field ?? null)) {
                        $merged->$field = $profile->$field;
                    }
                }
            }

            return $merged;
        }

        $profileFields = [
            'sl_name', 'sl_father_name', 'sl_mother_name', 'sl_dob', 'sl_sex',
            'sl_category', 'sl_address', 'sl_photo', 'sl_signature', 'sl_mobile_no', 'sl_email',
        ];

        $merged = clone $student;
        foreach ($profileFields as $field) {
            if (!is_weak_student_field($field, $merged->$field ?? null)) {
                continue;
            }

            foreach ($rows as $row) {
                $value = $row->$field ?? null;
                if (!is_weak_student_field($field, $value)) {
                    $merged->$field = $value;
                    break;
                }
            }
        }

        if (empty($merged->sl_reg_no)) {
            $merged->sl_reg_no = $regNo;
        }

        $profile = resolve_student_profile_by_reg_no($regNo);
        if ($profile) {
            foreach ($profileFields as $field) {
                if (is_weak_student_field($field, $merged->$field ?? null) && !is_weak_student_field($field, $profile->$field ?? null)) {
                    $merged->$field = $profile->$field;
                }
            }
        }

        return $merged;
    }
}

if (!function_exists('resolve_admit_card_course')) {
    function resolve_admit_card_course($admit, $student) {
        $courseId = (int) ($admit->course_id ?? $student->sl_FK_of_course_id ?? 0);
        if ($courseId <= 0) {
            return null;
        }

        return DB::table('course')->where('c_id', $courseId)->first();
    }
}

if (!function_exists('find_students_for_admit_context')) {
    /**
     * Students at the admit card's center + course (direct row or enrollment).
     */
    function find_students_for_admit_context($admit) {
        $centerId = (int) ($admit->center_id ?? 0);
        if ($centerId <= 0) {
            $center = resolve_center_for_admit($admit);
            $centerId = $center ? (int) $center->cl_id : 0;
        }

        $courseId = (int) ($admit->course_id ?? 0);
        if ($centerId <= 0 || $courseId <= 0) {
            return collect();
        }

        $enrolledIds = DB::table('student_enrollments')
            ->where('se_FK_of_center_id', $centerId)
            ->where('se_FK_of_course_id', $courseId)
            ->pluck('se_FK_of_student_id');

        return DB::table('student_login')
            ->where(function ($q) use ($centerId, $courseId, $enrolledIds) {
                $q->where(function ($inner) use ($centerId, $courseId) {
                    $inner->where('sl_FK_of_center_id', $centerId)
                        ->where('sl_FK_of_course_id', $courseId);
                });
                if ($enrolledIds->isNotEmpty()) {
                    $q->orWhereIn('sl_id', $enrolledIds);
                }
            })
            ->get();
    }
}

if (!function_exists('resolve_complete_students_for_admit_context')) {
    function resolve_complete_students_for_admit_context($admit) {
        return find_students_for_admit_context($admit)->filter(function ($student) {
            return !is_weak_student_field('sl_name', $student->sl_name ?? null)
                && !is_weak_student_field('sl_dob', $student->sl_dob ?? null);
        })->values();
    }
}

if (!function_exists('student_has_weak_admit_profile')) {
    function student_has_weak_admit_profile($student) {
        if (!$student) {
            return true;
        }

        return is_weak_student_field('sl_name', $student->sl_name ?? null)
            || is_weak_student_field('sl_dob', $student->sl_dob ?? null);
    }
}

if (!function_exists('merge_admit_student_profile')) {
    function merge_admit_student_profile($target, $source) {
        if (!$target || !$source) {
            return $target;
        }

        $fields = [
            'sl_name', 'sl_father_name', 'sl_mother_name', 'sl_dob', 'sl_sex',
            'sl_category', 'sl_address', 'sl_photo', 'sl_signature', 'sl_mobile_no', 'sl_email',
            'sl_reg_no', 'sl_FK_of_center_id', 'sl_FK_of_course_id',
        ];

        foreach ($fields as $field) {
            if (is_weak_student_field($field, $target->$field ?? null) && !is_weak_student_field($field, $source->$field ?? null)) {
                $target->$field = $source->$field;
            }
        }

        return $target;
    }
}

if (!function_exists('repair_admit_card_student')) {
    /**
     * Fix placeholder/legacy admit links by matching center + course to the real student.
     */
    function repair_admit_card_student($admit, $persist = true) {
        $student = resolve_admit_card_student($admit);
        if (!$student) {
            return null;
        }

        if (!student_has_weak_admit_profile($student)) {
            return $student;
        }

        $completeStudents = resolve_complete_students_for_admit_context($admit);
        if ($completeStudents->isEmpty()) {
            return $student;
        }

        $match = $completeStudents->count() === 1
            ? $completeStudents->first()
            : $completeStudents->sortByDesc('sl_id')->first();

        if (!$match) {
            return $student;
        }

        $linkedId = (int) ($admit->student_id ?? 0);
        $shouldRelink = $linkedId <= 0 || $linkedId !== (int) $match->sl_id;

        if ($shouldRelink && $persist && !empty($admit->ac_id)) {
            DB::table('student_admit_cards')
                ->where('ac_id', $admit->ac_id)
                ->update([
                    'student_id' => $match->sl_id,
                    'reg_no' => $match->sl_reg_no,
                    'center_id' => (int) ($match->sl_FK_of_center_id ?? $admit->center_id ?? 0),
                    'course_id' => (int) ($match->sl_FK_of_course_id ?? $admit->course_id ?? 0),
                    'updated_at' => now(),
                ]);
        }

        $merged = merge_admit_student_profile(clone $student, $match);
        $merged->sl_id = $match->sl_id;

        return $merged;
    }
}

if (!function_exists('admit_card_view_data')) {
    function admit_card_view_data($admitId) {
        $admit = DB::table('student_admit_cards')->where('ac_id', $admitId)->first();
        if (!$admit) {
            return null;
        }

        $student = repair_admit_card_student($admit, true);
        if (!$student) {
            return null;
        }

        $admit = DB::table('student_admit_cards')->where('ac_id', $admitId)->first();
        $student = resolve_admit_card_student($admit);
        if (!$student) {
            $student = DB::table('student_login')->where('sl_id', $admit->student_id)->first();
        }

        $course = resolve_admit_card_course($admit, $student);
        $center = resolve_center_for_admit((object) array_merge((array) $admit, [
            'sl_FK_of_center_id' => $student->sl_FK_of_center_id ?? null,
        ]));
        $setting = DB::table('site_settings')->first();

        return compact('admit', 'student', 'course', 'center', 'setting');
    }
}

if (!function_exists('enrich_admit_card_list_item')) {
    /**
     * Fill missing student/center fields on an admit card list row.
     */
    function enrich_admit_card_list_item($row) {
        $repaired = repair_admit_card_student($row, true);
        if ($repaired) {
            $row->sl_name = $repaired->sl_name ?? $row->sl_name;
            $row->sl_dob = $repaired->sl_dob ?? $row->sl_dob;
            $row->sl_reg_no = $repaired->sl_reg_no ?? $row->reg_no ?? $row->sl_reg_no;
            $row->reg_no = $repaired->sl_reg_no ?? $row->reg_no;
            if (!empty($repaired->sl_id)) {
                $row->student_id = $repaired->sl_id;
            }
        }

        $regNo = trim((string) ($row->reg_no ?? $row->sl_reg_no ?? ''));
        if ($regNo !== '') {
            $profile = resolve_student_profile_by_reg_no($regNo);
            if ($profile) {
                if (is_weak_student_field('sl_name', $row->sl_name ?? null) && !is_weak_student_field('sl_name', $profile->sl_name ?? null)) {
                    $row->sl_name = $profile->sl_name;
                }
                if (is_weak_student_field('sl_dob', $row->sl_dob ?? null) && !is_weak_student_field('sl_dob', $profile->sl_dob ?? null)) {
                    $row->sl_dob = $profile->sl_dob;
                }
            }
        }

        $center = resolve_center_for_admit($row);
        if ($center) {
            $row->center_name = $center->cl_center_name ?? $center->cl_name;
            if ((int) ($row->center_id ?? 0) <= 0 && !empty($row->ac_id)) {
                DB::table('student_admit_cards')
                    ->where('ac_id', $row->ac_id)
                    ->update(['center_id' => $center->cl_id]);
                $row->center_id = $center->cl_id;
            }
        }

        return $row;
    }
}