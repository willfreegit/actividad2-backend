<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Benefits extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $primaryKey = 'ben_id';

    protected $fillable = [
        'abs_id',
        'ben_description',
        'ben_referable'
    ];
}
