<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rules extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'rul_id';

    protected $fillable = [
        'ben_id',
        'rul_min_value_for_calculation',
        'rul_max_value_for_calculation',
        'rul_number_of_benefit_days',
        'rul_sequential_aplicacion_rule'
    ];
}
