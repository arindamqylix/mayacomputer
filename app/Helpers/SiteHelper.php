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

if (!function_exists('format_dob_display_html')) {
    /**
     * Date of birth with small superscript ordinal suffix, e.g. 1<sup>st</sup> Jan, 2015
     */
    function format_dob_display_html($date, $default = 'N/A', $uppercase = false) {
        if ($date === null || $date === '' || $date === '0000-00-00' || $date === '0000-00-00 00:00:00') {
            return e($default);
        }
        try {
            $d = \Carbon\Carbon::parse($date);
        } catch (\Exception $e) {
            return e(is_string($date) ? $date : $default);
        }
        $day = (int) $d->format('j');
        if (in_array($day % 100, [11, 12, 13], true)) {
            $suffix = 'th';
        } else {
            $suffix = [1 => 'st', 2 => 'nd', 3 => 'rd'][$day % 10] ?? 'th';
        }
        $monthYear = $d->format('M') . ', ' . $d->format('Y');
        if ($uppercase) {
            $suffix = strtoupper($suffix);
            $monthYear = strtoupper($monthYear);
        }
        $ordinal = '<sup style="font-size:0.5em; vertical-align:super; line-height:0;">' . $suffix . '</sup>';

        return $day . $ordinal . ' ' . e($monthYear);
    }
}

if (!function_exists('format_marksheet_center_code_address_html')) {
    /**
     * Center code + address for marksheet — city, state and PIN on a second line when detectable.
     */
    function format_marksheet_center_code_address_html(?string $code, ?string $address): string
    {
        $code = e(trim((string) ($code ?? 'N/A')));
        $address = trim((string) ($address ?? ''));

        if ($address === '' || strtoupper($address) === 'N/A') {
            return '&nbsp;' . $code . ' &amp; N/A';
        }

        $addressHtml = e($address);
        if (preg_match('/^(.+?),\s*([^,]+,\s*[^,]+,\s*PIN\s*:?\s*\d+.*)$/iu', $address, $matches)) {
            $addressHtml = e(trim($matches[1])) . '<br>&nbsp;' . e(trim($matches[2]));
        }

        return '&nbsp;' . $code . ' &amp; ' . $addressHtml;
    }
}

if (!function_exists('admit_card_public_img')) {
    /**
     * Image src for admit card — file path for DomPDF, asset URL for browser.
     */
    function admit_card_public_img($relativePath, $forPdf = false) {
        if ($relativePath === null || trim((string) $relativePath) === '') {
            return null;
        }
        $relative = ltrim(str_replace('\\', '/', (string) $relativePath), '/');
        $full = public_path($relative);
        if (!is_file($full)) {
            return null;
        }

        return $forPdf ? $full : asset($relative);
    }
}

if (!function_exists('ensure_admit_card_pdf_font')) {
    /**
     * Register Devanagari font with DomPDF (storage/fonts).
     */
    function ensure_admit_card_pdf_font() {
        $fontDir = storage_path('fonts');
        if (!is_dir($fontDir)) {
            mkdir($fontDir, 0755, true);
        }

        $source = public_path('fonts/NotoSansDevanagari-Regular.ttf');
        $target = $fontDir . DIRECTORY_SEPARATOR . 'NotoSansDevanagari-Regular.ttf';
        if (is_file($source)) {
            if (!is_file($target) || filesize($target) !== filesize($source)) {
                copy($source, $target);
            }
        }

        $ufmPath = $fontDir . DIRECTORY_SEPARATOR . 'NotoSansDevanagari-Regular.ufm';
        if (is_file($target) && !is_file($ufmPath) && class_exists(\FontLib\Font::class)) {
            try {
                $font = \FontLib\Font::load($target);
                $font->parse();
                $font->saveAdobeFontMetrics($ufmPath);
                $font->close();
            } catch (\Throwable $e) {
                // DomPDF may still load the TTF directly.
            }
        }

        $registryFile = $fontDir . DIRECTORY_SEPARATOR . 'installed-fonts.json';
        $registry = is_readable($registryFile)
            ? (json_decode(file_get_contents($registryFile), true) ?: [])
            : [];

        if (is_file($target)) {
            $registry['noto devanagari'] = ['normal' => 'NotoSansDevanagari-Regular'];
            file_put_contents($registryFile, json_encode($registry, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
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

if (!function_exists('next_certificate_number')) {
    /**
     * Next sequential certificate number (TYP0001, TYP0002, …).
     * Reuses the lowest available number when certificates are deleted.
     */
    function next_certificate_number(string $prefix, int $padLength = 4): string
    {
        $pattern = '/^' . preg_quote($prefix, '/') . '(\d+)$/';

        $usedNumbers = DB::table('student_certificates')
            ->where('sc_certificate_number', 'like', $prefix . '%')
            ->pluck('sc_certificate_number')
            ->map(function ($number) use ($pattern) {
                if (preg_match($pattern, (string) $number, $matches)) {
                    return (int) $matches[1];
                }

                return null;
            })
            ->filter(fn ($n) => $n !== null && $n > 0)
            ->unique()
            ->sort()
            ->values()
            ->all();

        $next = 1;
        foreach ($usedNumbers as $used) {
            if ($used > $next) {
                break;
            }
            if ($used === $next) {
                $next++;
            }
        }

        return $prefix . str_pad((string) $next, $padLength, '0', STR_PAD_LEFT);
    }
}

if (!function_exists('student_course_names')) {
    /**
     * Comma-separated short names of all courses a student is enrolled in (login rows + enrollments).
     */
    function student_course_names(string $regNo, int $centerId): string
    {
        $slIds = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->pluck('sl_id');

        $fromLogin = DB::table('student_login')
            ->join('course', 'student_login.sl_FK_of_course_id', '=', 'course.c_id')
            ->where('student_login.sl_reg_no', $regNo)
            ->where('student_login.sl_FK_of_center_id', $centerId)
            ->whereNotNull('student_login.sl_FK_of_course_id')
            ->pluck('course.c_short_name');

        $fromEnrollments = collect();
        if ($slIds->isNotEmpty()) {
            $fromEnrollments = DB::table('student_enrollments')
                ->join('course', 'student_enrollments.se_FK_of_course_id', '=', 'course.c_id')
                ->where('student_enrollments.se_FK_of_center_id', $centerId)
                ->whereIn('student_enrollments.se_FK_of_student_id', $slIds)
                ->pluck('course.c_short_name');
        }

        return $fromLogin->merge($fromEnrollments)->unique()->sort()->values()->implode(', ');
    }
}

if (!function_exists('typing_course_sql')) {
    function typing_course_sql(string $courseAlias = 'c'): string
    {
        $c = $courseAlias;

        return "({$c}.is_typing_related = 1 OR LOWER(TRIM(COALESCE({$c}.category_name,''))) = 'typing' OR {$c}.c_short_name LIKE '%Typing%' OR {$c}.c_full_name LIKE '%Typing%')";
    }
}

if (!function_exists('typing_certificate_eligible_students')) {
    /**
     * Students eligible for a typing certificate — one row per reg no + center + typing course.
     */
    function typing_certificate_eligible_students(?int $centerId = null): \Illuminate\Support\Collection
    {
        $typingSql = typing_course_sql('c');
        $centerFilterLogin = $centerId ? 'AND s.sl_FK_of_center_id = ' . (int) $centerId : '';
        $centerFilterEnroll = $centerId ? 'AND se.se_FK_of_center_id = ' . (int) $centerId : '';

        $enrolledSubSql = "
            SELECT
                COALESCE(
                    (SELECT s2.sl_id FROM student_login s2
                     WHERE s2.sl_reg_no = enr.sl_reg_no
                       AND s2.sl_FK_of_center_id = enr.center_id
                       AND s2.sl_FK_of_course_id = enr.cid
                     ORDER BY s2.sl_id ASC LIMIT 1),
                    MIN(enr.sl_id)
                ) AS sid,
                enr.cid,
                enr.sl_reg_no,
                enr.center_id
            FROM (
                SELECT s.sl_id, s.sl_reg_no, s.sl_FK_of_center_id AS center_id, c.c_id AS cid
                FROM student_login s
                JOIN course c ON c.c_id = s.sl_FK_of_course_id
                WHERE {$typingSql} {$centerFilterLogin}
                UNION ALL
                SELECT se.se_FK_of_student_id, s.sl_reg_no, se.se_FK_of_center_id, c.c_id
                FROM student_enrollments se
                JOIN course c ON c.c_id = se.se_FK_of_course_id
                JOIN student_login s ON s.sl_id = se.se_FK_of_student_id
                WHERE {$typingSql} {$centerFilterEnroll}
            ) AS enr
            GROUP BY enr.sl_reg_no, enr.center_id, enr.cid
        ";

        return DB::table(DB::raw("({$enrolledSubSql}) AS enr"))
            ->join('student_login', 'student_login.sl_id', '=', 'enr.sid')
            ->join('course', 'course.c_id', '=', 'enr.cid')
            ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
            ->whereNotExists(function ($query) {
                $query->select(DB::raw(1))
                    ->from('student_certificates as sc')
                    ->join('student_login as cert_sl', 'cert_sl.sl_id', '=', 'sc.sc_FK_of_student_id')
                    ->whereColumn('sc.sc_FK_of_course_id', 'enr.cid')
                    ->where('sc.sc_type', 'TYPING')
                    ->whereColumn('cert_sl.sl_reg_no', 'enr.sl_reg_no')
                    ->whereColumn('cert_sl.sl_FK_of_center_id', 'enr.center_id');
            })
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
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_name', 'ASC')
            ->get();
    }
}

if (!function_exists('student_sl_ids_for_person')) {
    function student_sl_ids_for_person(string $regNo, int $centerId): array
    {
        return DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->pluck('sl_id')
            ->map(fn ($id) => (int) $id)
            ->all();
    }
}

if (!function_exists('non_typing_course_sql')) {
    function non_typing_course_sql(string $courseAlias = 'c'): string
    {
        return 'NOT ' . typing_course_sql($courseAlias);
    }
}

if (!function_exists('student_course_enrollment_rows')) {
    /**
     * One row per reg no + center + course (deduped login + student_enrollments).
     *
     * @param  bool|null  $typingOnly  true = typing only, false = non-typing only, null = all
     */
    function student_course_enrollment_rows(?int $centerId = null, ?bool $typingOnly = null): \Illuminate\Support\Collection
    {
        if ($typingOnly === true) {
            $courseFilter = typing_course_sql('c');
        } elseif ($typingOnly === false) {
            $courseFilter = non_typing_course_sql('c');
        } else {
            $courseFilter = '1=1';
        }

        $centerFilterLogin = $centerId ? 'AND s.sl_FK_of_center_id = ' . (int) $centerId : '';
        $centerFilterEnroll = $centerId ? 'AND se.se_FK_of_center_id = ' . (int) $centerId : '';

        $enrolledSubSql = "
            SELECT
                COALESCE(
                    (SELECT s2.sl_id FROM student_login s2
                     WHERE s2.sl_reg_no = enr.sl_reg_no
                       AND s2.sl_FK_of_center_id = enr.center_id
                       AND s2.sl_FK_of_course_id = enr.cid
                     ORDER BY s2.sl_id ASC LIMIT 1),
                    MIN(enr.sl_id)
                ) AS sid,
                enr.cid,
                enr.sl_reg_no,
                enr.center_id
            FROM (
                SELECT s.sl_id, s.sl_reg_no, s.sl_FK_of_center_id AS center_id, c.c_id AS cid
                FROM student_login s
                JOIN course c ON c.c_id = s.sl_FK_of_course_id
                WHERE {$courseFilter} {$centerFilterLogin}
                UNION ALL
                SELECT se.se_FK_of_student_id, s.sl_reg_no, se.se_FK_of_center_id, c.c_id
                FROM student_enrollments se
                JOIN course c ON c.c_id = se.se_FK_of_course_id
                JOIN student_login s ON s.sl_id = se.se_FK_of_student_id
                WHERE {$courseFilter} {$centerFilterEnroll}
            ) AS enr
            GROUP BY enr.sl_reg_no, enr.center_id, enr.cid
        ";

        return DB::table(DB::raw("({$enrolledSubSql}) AS enr"))
            ->join('student_login', 'student_login.sl_id', '=', 'enr.sid')
            ->join('course', 'course.c_id', '=', 'enr.cid')
            ->join('center_login', 'student_login.sl_FK_of_center_id', '=', 'center_login.cl_id')
            ->select(
                'enr.sid as sl_id',
                'enr.cid as course_id',
                'enr.sl_reg_no',
                'enr.center_id',
                'student_login.sl_name',
                'student_login.sl_photo',
                'course.c_full_name',
                'course.c_short_name',
                'center_login.cl_center_name',
                'center_login.cl_code'
            )
            ->orderBy('student_login.sl_name')
            ->orderBy('course.c_short_name')
            ->get();
    }
}

if (!function_exists('admit_card_exists_for_course')) {
    function admit_card_exists_for_course(string $regNo, int $centerId, int $courseId): bool
    {
        $slIds = student_sl_ids_for_person($regNo, $centerId);

        return DB::table('student_admit_cards')
            ->where('course_id', $courseId)
            ->where('center_id', $centerId)
            ->where(function ($query) use ($slIds, $regNo) {
                if ($slIds !== []) {
                    $query->whereIn('student_id', $slIds);
                }
                $query->orWhere('reg_no', $regNo);
            })
            ->exists();
    }
}

if (!function_exists('admit_card_eligible_enrollments')) {
    /**
     * One row per verified enrollment without an admit card yet (all courses incl. typing).
     */
    function admit_card_eligible_enrollments(?int $centerId = null): \Illuminate\Support\Collection
    {
        return student_course_enrollment_rows($centerId, null)
            ->map(function ($row) {
                $regNo = (string) $row->sl_reg_no;
                $cid = (int) $row->center_id;
                $courseId = (int) $row->course_id;
                $login = DB::table('student_login')->where('sl_id', $row->sl_id)->first();
                if ($login) {
                    $row->sl_dob = $login->sl_dob;
                    $row->sl_email = $login->sl_email ?? null;
                }
                $row->sl_FK_of_course_id = $courseId;
                $row->sl_FK_of_center_id = $cid;
                $row->center_name = $row->cl_center_name ?? null;
                $row->enrollment_status = enrollment_status_for_course($regNo, $cid, $courseId);

                return $row;
            })
            ->filter(function ($row) {
                if (($row->enrollment_status ?? '') !== 'VERIFIED') {
                    return false;
                }

                return !admit_card_exists_for_course(
                    (string) $row->sl_reg_no,
                    (int) $row->center_id,
                    (int) $row->course_id
                );
            })
            ->values();
    }
}

if (!function_exists('enrollment_status_for_course')) {
    function enrollment_status_for_course(string $regNo, int $centerId, int $courseId): string
    {
        $loginStatus = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->value('sl_status');

        if ($loginStatus) {
            return (string) $loginStatus;
        }

        $slIds = student_sl_ids_for_person($regNo, $centerId);
        if ($slIds === []) {
            return 'PENDING';
        }

        $enrollStatus = DB::table('student_enrollments')
            ->where('se_FK_of_center_id', $centerId)
            ->where('se_FK_of_course_id', $courseId)
            ->whereIn('se_FK_of_student_id', $slIds)
            ->value('se_status');

        return $enrollStatus ? (string) $enrollStatus : 'PENDING';
    }
}

if (!function_exists('result_exists_for_course')) {
    function result_exists_for_course(string $regNo, int $centerId, int $courseId): bool
    {
        $slIds = student_sl_ids_for_person($regNo, $centerId);
        if ($slIds === []) {
            return false;
        }

        return DB::table('set_result')
            ->where('sr_FK_of_course_id', $courseId)
            ->whereIn('sr_FK_of_student_id', $slIds)
            ->exists();
    }
}

if (!function_exists('resolve_student_sl_id_for_course')) {
    function resolve_student_sl_id_for_course(string $regNo, int $centerId, int $courseId, int $fallbackSlId): int
    {
        $loginSlId = DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->orderBy('sl_id')
            ->value('sl_id');

        return $loginSlId ? (int) $loginSlId : $fallbackSlId;
    }
}

if (!function_exists('result_pending_enrollments')) {
    /**
     * Non-typing enrollments eligible for Set Result (new or update when VERIFIED).
     */
    function result_pending_enrollments(?int $centerId = null): \Illuminate\Support\Collection
    {
        return student_course_enrollment_rows($centerId, false)
            ->filter(function ($row) {
                $regNo = (string) $row->sl_reg_no;
                $centerId = (int) $row->center_id;
                $courseId = (int) $row->course_id;
                $status = enrollment_status_for_course($regNo, $centerId, $courseId);
                $hasResult = result_exists_for_course($regNo, $centerId, $courseId);

                if (in_array($status, ['PENDING', 'BLOCK'], true)) {
                    return false;
                }

                // Allow update when admin set course back to VERIFIED
                if ($hasResult) {
                    return $status === 'VERIFIED';
                }

                return true;
            })
            ->values();
    }
}

if (!function_exists('find_result_for_course')) {
    function find_result_for_course(string $regNo, int $centerId, int $courseId): ?object
    {
        $slIds = student_sl_ids_for_person($regNo, $centerId);
        if ($slIds === []) {
            return null;
        }

        return DB::table('set_result')
            ->where('sr_FK_of_course_id', $courseId)
            ->whereIn('sr_FK_of_student_id', $slIds)
            ->first();
    }
}

if (!function_exists('mark_course_result_out')) {
    function mark_course_result_out(string $regNo, int $centerId, int $courseId, int $resultSlId): void
    {
        DB::table('student_login')
            ->where('sl_reg_no', $regNo)
            ->where('sl_FK_of_center_id', $centerId)
            ->where('sl_FK_of_course_id', $courseId)
            ->update(['sl_status' => 'RESULT OUT', 'updated_at' => now()]);

        $slIds = student_sl_ids_for_person($regNo, $centerId);
        if ($slIds !== []) {
            DB::table('student_enrollments')
                ->where('se_FK_of_center_id', $centerId)
                ->where('se_FK_of_course_id', $courseId)
                ->whereIn('se_FK_of_student_id', $slIds)
                ->update(['se_status' => 'RESULT OUT', 'updated_at' => now()]);
        }

        DB::table('student_login')
            ->where('sl_id', $resultSlId)
            ->update(['sl_status' => 'RESULT OUT', 'updated_at' => now()]);
    }
}