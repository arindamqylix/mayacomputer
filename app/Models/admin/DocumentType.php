<?php

namespace App\Models\admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentType extends Model
{
    use HasFactory;
    
    protected $table = 'document_types';
    protected $primaryKey = 'dt_id';
    
    protected $fillable = [
        'dt_name',
        'dt_amount',
        'dt_status'
    ];
}
