<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vacations extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'vac_id';

    protected $fillable = [
        'vac_year',
        'vac_year_start_date',
        'vac_year_end_date',
        'vac_taken_days',
        'vac_balance_annual_days',
        'epl_id',
    ];
}
