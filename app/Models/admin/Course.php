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
    'c_module_cover',     // you already have
    'file',               // thumbnail / pdf / image (whatever you upload)
    'description',        // course description (long text)
    'category_name',      // course category
    'course_syllabus',    // syllabus JSON
    'information',        // course info JSON
    'slug',               // auto generated slug
];

}
