<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GenericValue extends Model
{
    protected $table = 'generic_values';

    // Allow mass assignment for these columns
    protected $fillable = [
        'type',
        'value',
        'status',
    ];
}
