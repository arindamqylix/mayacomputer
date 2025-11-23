<?php

namespace App\Models\center;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Center extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "center_login";
    protected $primaryKey = "cl_id";
    protected $fillable = [
    	'cl_code',
    	'cl_center_name',
    	'cl_director_name',
    	'cl_center_address',
        'cl_cin_no',
    	'cl_name',
    	'cl_photo',
        'cl_wallet_balance',
        'cl_authorized_signature',
        'cl_logo',
        'cl_center_stamp',
        'cl_center_signature',
        'cl_director_adhar',
        'cl_director_pan',
        'cl_director_education',
    	'cl_mobile',
    	'cl_email',
        'cl_account_status',
    	'password'
    ];

}
