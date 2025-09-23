<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBCategory extends Model
{
    use HasFactory;

    protected $table = 'kb_categories';

    protected $fillable = [
        'name',
        'image',
        'parent_id',
        'short_desc',
        'status',
        'is_hidden',
        'is_popular',
    ];

    // A category may have subcategories
    public function subcategories()
    {
        return $this->hasMany(KBCategory::class, 'parent_id');
    }

    // A category belongs to a parent category
    public function parent()
    {
        return $this->belongsTo(KBCategory::class, 'parent_id');
    }

    // Later: A category can have many boards
    public function boards()
    {
        return $this->hasMany(KBBoard::class, 'category_id');
    }
}
