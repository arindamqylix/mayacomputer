<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentRegFee extends Model
{
    use HasFactory;
    protected $table = "student_reg_fee";
    protected $primaryKey = "srf_id";
    protected $fillable = [
    	'srf_amount',
    ];
}
