<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Smtp extends Model
{
    use HasFactory;

    protected $table = 'smtps';

    protected $fillable = [
        'provider_name',
        'username',
    ];
}
