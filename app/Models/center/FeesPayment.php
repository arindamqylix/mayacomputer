<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeesPayment extends Model
{
    use HasFactory;
    protected $table = 'fees_payment';
    protected $primaryKey = 'fp_id';
    protected $fillable = [
        'fp_receipt_no',
        'fp_FK_of_student_id',
    	'fp_FK_of_center_id',
    	'fp_date',
        'fp_total_amount',
    	'fp_amount',
    	'fp_remarks',
    	'fp_is_invoice'
    ];
    
    // Relationship with Student
    public function student()
    {
        return $this->belongsTo(\App\Models\student\Student::class, 'fp_FK_of_student_id', 'sl_id');
    }
    
    // Relationship with Center
    public function center()
    {
        return $this->belongsTo(Center::class, 'fp_FK_of_center_id', 'cl_id');
    }
}
