<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SetFee extends Model
{
    use HasFactory;
    protected $table = 'set_fee';
    protected $primaryKey = 'sf_id ';
    protected $fillable = [
        'sf_FK_of_student_id',
    	'sf_FK_of_center_id',
    	'sf_amount',
    	'sf_paid',
    	'sf_due'
    ];
}
