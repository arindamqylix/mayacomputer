<?php

namespace App\Models\student;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentReissueRequest extends Model
{
    use HasFactory;
    
    protected $table = 'document_reissue_requests';
    protected $primaryKey = 'drr_id';
    
    protected $fillable = [
        'drr_FK_of_student_id',
        'drr_document_type',
        'drr_status',
        'drr_amount',
        'drr_payment_status',
        'drr_payment_id',
        'drr_remarks',
        'drr_admin_remarks',
        'drr_processed_at'
    ];
    
    protected $casts = [
        'drr_amount' => 'decimal:2',
        'drr_requested_at' => 'datetime',
        'drr_processed_at' => 'datetime',
    ];
    
    // Relationships
    public function student()
    {
        return $this->belongsTo(Student::class, 'drr_FK_of_student_id', 'sl_id');
    }
}

