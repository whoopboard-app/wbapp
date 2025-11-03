<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subscriber extends Model
{
    use HasFactory;

    protected $fillable = [
        'full_name',
        'email',
        'token',
        'verified',
        'linkedin_url',
        'subscribe_date',
        'short_desc',
        'userSegments',
        'addType',
        'status',
    ];

    protected $casts = [
        'verified' => 'boolean',
        'subscribe_date' => 'datetime',
        'userSegments' => 'array',
        'status' => 'integer',
    ];
}
