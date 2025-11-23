<?php

namespace App\Models\student;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Student extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = 'student_login';
    protected $primaryKey = 'sl_id';
    protected $fillable = [
    	'sl_FK_of_course_id',
    	'sl_FK_of_center_id',
    	'sl_dob',
    	'sl_qualification',
    	'sl_reg_no',
    	'sl_sex',
    	'sl_address',
    	'sl_name',
    	'sl_photo',
    	'sl_id_card',
    	'sl_mother_name',
    	'sl_mobile_no',
    	'sl_father_name',
    	'sl_educational_certificate',
        'sl_email',
    	'password',
    ];

}
