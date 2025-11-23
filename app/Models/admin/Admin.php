<?php

namespace App\Models\admin;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "admin_login";
    protected $primaryKey = "al_id";
    protected $fillable = [
    	'al_email',
    	'password'
    ];

}
