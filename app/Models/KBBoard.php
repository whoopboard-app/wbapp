<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\KBCategory;
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
    public function categories()
    {
        return $this->hasMany(KBCategory::class, 'board_id');
    }
    public function articles()
    {
        return $this->hasManyThrough(KBArticle::class, KBCategory::class, 'board_id', 'category_id');
    }
}
