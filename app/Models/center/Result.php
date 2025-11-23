<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;
    protected $table = 'set_result';
    protected $primaryKey = 'sr_id';
    protected $fillable = [
    	'sr_FK_of_student_id',
        'sr_FK_of_center_id',
    	'sr_written',
    	'sr_wr_full_marks',
    	'sr_wr_pass_marks',
    	'sr_wr_marks_obtained',
    	'sr_practical',
    	'sr_pr_full_marks',
    	'sr_pr_pass_marks',
    	'sr_pr_marks_obtained',
    	'sr_project',
    	'sr_ap_full_marks',
    	'sr_ap_pass_marks',
    	'sr_ap_marks_obtained',
    	'sr_viva',
    	'sr_vv_full_marks',
    	'sr_vv_pass_marks',
    	'sr_vv_marks_obtained',
    	'sr_total_full_marks',
    	'sr_total_pass_marks',
    	'sr_total_marks_obtained',
    	'sr_percentage',
    	'sr_grade'
    ];
}
