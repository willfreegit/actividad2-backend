<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Holidays extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'hol_id';

    protected $fillable = [
        'hol_holiday_name',
        'hol_holiday_date'
    ];
}
