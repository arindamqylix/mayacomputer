<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSyllabus extends Model
{
    use HasFactory;
    protected $table = 'course_syllabus';
    protected $primaryKey = 'cs_id';
    protected $fillable = [
        'cs_FK_of_course_id',
        'cs_type',
        'cs_title',
        'cs_description',
        'cs_video_url',
        'cs_pdf_file',
        'cs_order',
        'cs_status'
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'cs_FK_of_course_id', 'c_id');
    }
}

