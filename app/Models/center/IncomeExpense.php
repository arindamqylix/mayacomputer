<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeExpense extends Model
{
    use HasFactory;
    protected $table = 'income_expense';
    protected $primaryKey = 'ie_id';
    protected $fillable = [
        'ie_FK_of_center_id',
    	'ie_FK_of_admin_id',
    	'ie_type',
    	'ie_date',
    	'ie_amount',
    	'ie_mode',
    	'ie_remarks'
    ];
}
