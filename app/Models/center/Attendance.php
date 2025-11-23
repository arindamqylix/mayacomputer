<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model
{
    use HasFactory;
    protected $table = 'attendence_batch';
    protected $primaryKey = 'ab_id';
    protected $fillable = [
    	'ab_FK_of_center_id',
    	'ab_name',
    	'ab_start_time',
    	'ab_end_time',
    	'ab_status',
    ];
}
