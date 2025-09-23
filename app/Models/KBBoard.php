<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KBBoard extends Model
{
    use HasFactory;

    protected $table = 'kb_boards';

    protected $fillable = [
        'name',
        'description',
        'type',
        'docs_type',
        'is_hidden',
        'public_url',
        'embed_code',
    ];
}
