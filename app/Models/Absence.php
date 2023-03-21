<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Absence extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'abs_id';

    protected $fillable = [
        'abs_description',
        'abs_referable'
    ];
}
