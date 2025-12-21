<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certificate extends Model
{
    use HasFactory;
    protected $table = 'student_certificates';
    protected $primaryKey = 'sc_id';
    protected $fillable = [
        'sc_FK_of_student_id',
        'sc_FK_of_center_id',
        'sc_FK_of_result_id',
        'sc_certificate_number',
        'sc_issue_date',
        'sc_status'
    ];

    protected $dates = ['sc_issue_date'];
}

