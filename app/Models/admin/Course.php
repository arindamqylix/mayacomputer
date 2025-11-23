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
    	'c_module_cover',
    ];
}
