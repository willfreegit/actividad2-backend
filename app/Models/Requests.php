<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Requests extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'req_id';

    protected $fillable = [
        'epl_id',
        'abs_id',
        'req_entry_request_date',
        'req_status',
        'req_absence_start_date',
        'req_absence_end_date',
        'req_days_requested',
        'req_comments'
    ];
}
