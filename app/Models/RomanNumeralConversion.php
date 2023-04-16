<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RomanNumeralConversion extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'input',
        'output',
        'last_converted_at',
        'total_conversions',
    ];
}
