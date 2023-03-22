<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Approvals extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'aut_id';

    protected $fillable = [
        'req_id',
        'epl_approval_id',
        'aut_sequential_approval_flow',
        'aut_submission_date_for_approval',
        'aut_approval_action_date',
        'aut_action',
        'aut_approval_comments'
    ];
}
