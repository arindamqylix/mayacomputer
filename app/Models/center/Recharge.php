<?php

namespace App\Models\center;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recharge extends Model
{
    use HasFactory;
    protected $table = 'center_recharge';
    protected $primaryKey = 'cr_id';
    protected $fillable = [
    	'cr_payment_id',
    	'cr_FK_of_center_id',
    	'cr_amount',
    ];
}
