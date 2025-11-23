<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceSet extends Model
{
    use HasFactory;
    protected $table = 'attendence_set';
    protected $primaryKey = 'as_id';
    protected $fillable = [
    	'as_FK_of_student_id',
    	'as_FK_of_attendance_batch_id',
    	'as_FK_of_center_id',
    ];
}
