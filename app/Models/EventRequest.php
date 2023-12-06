<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EventRequest extends Model
{
    use HasFactory,SoftDeletes;
    
    protected $fillable = [
        'request_type',
        'req_email',
        'req_name',
        'req_phone',
        'req_region',
        'resv_id',
        'priority',
        'subject',
        'status',
        'description',
        'attachment',
        'rating',
        'feedback',
        'tentative_date',
        'handover_date',
        'closer_date',
    ];
}
