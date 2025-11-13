<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SegmentField extends Model
{
    use HasFactory;

    protected $table = 'segment_fields';

    protected $fillable = [
        'field_name',
        'status',
    ];
}
