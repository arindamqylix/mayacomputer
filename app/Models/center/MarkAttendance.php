<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MarkAttendance extends Model
{
    use HasFactory;
    protected $table = 'attendance_mark';
    protected $primaryKey = 'am_id';
    protected $fillable = [
        'am_FK_of_batch_id',
    	'am_FK_of_student_id',
    	'am_FK_of_center_id',
    	'am_status',
    	'am_date'
    ];
}
