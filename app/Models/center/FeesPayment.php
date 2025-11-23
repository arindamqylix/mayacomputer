<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesPayment extends Model
{
    use HasFactory;
    protected $table = 'fees_payment';
    protected $primaryKey = 'sf_id ';
    protected $fillable = [
        'fp_receipt_no',
        'fp_FK_of_student_id',
    	'fp_FK_of_center_id',
    	'fp_date',
        'fp_total_amount',
    	'fp_amount',
    	'fp_remarks'
    ];
}
