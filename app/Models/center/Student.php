<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;
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
		'password',
    	'sl_photo',
    	'sl_id_card',
    	'sl_mother_name',
    	'sl_mobile_no',
    	'sl_father_name',
    	'sl_educational_certificate',
    	'sl_email',
    	'sl_reg_date',
    	'sl_category'
    ];
}
