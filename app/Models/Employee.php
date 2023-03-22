<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'epl_id';

    protected $fillable = [
        'epl_identity_document',
        'epl_name',
        'epl_lastname',
        'epl_DOB',
        'epl_document_type',
        'epl_email',
        'epl_last_entry_date',
        'epl_last_exit_date',
        'epl_employee_status',
        'dep_id'
    ];
}
