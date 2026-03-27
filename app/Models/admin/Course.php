<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;
    protected $table = 'course';
    protected $primaryKey = 'c_id';
    protected $fillable = [
    'c_short_name',
    'c_full_name',
    'c_price',
    'c_duration',
    'is_typing_related',
    'c_module_cover',     // you already have
    'file',               // thumbnail / pdf / image (whatever you upload)
    'description',        // course description (long text)
    'category_name',      // course category
    'course_syllabus',    // syllabus JSON
    'information',        // course info JSON
    'slug',               // auto generated slug
];

    /**
     * Typing-related courses skip admit card + marksheet result; use typing certificate instead.
     */
    public static function isTypingRelated(?int $courseId): bool
    {
        if (!$courseId) {
            return false;
        }

        $v = static::query()->where('c_id', $courseId)->value('is_typing_related');

        return (int) $v === 1;
    }

    /**
     * Typing certificate list: explicit flag or legacy name/category match.
     */
    public static function qualifiesForTypingCertificateById(int $courseId): bool
    {
        $c = static::query()->where('c_id', $courseId)->first();
        if (!$c) {
            return false;
        }
        if ((int) ($c->is_typing_related ?? 0) === 1) {
            return true;
        }
        if (strtolower(trim($c->category_name ?? '')) === 'typing') {
            return true;
        }
        if (stripos($c->c_short_name ?? '', 'typing') !== false) {
            return true;
        }
        if (stripos($c->c_full_name ?? '', 'typing') !== false) {
            return true;
        }

        return false;
    }

}
