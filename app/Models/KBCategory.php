<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBCategory extends Model
{
    use HasFactory;

    protected $table = 'kb_categories';

    protected $fillable = [
        'board_id',
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
    public function childrenRecursive()
    {
        return $this->hasMany(KBCategory::class, 'parent_id')
            ->with(['articles', 'childrenRecursive']);
    }

    // A category belongs to a parent category
    public function parent()
    {
        return $this->belongsTo(KBCategory::class, 'parent_id');
    }
    public function board()
    {
        return $this->belongsTo(KBBoard::class, 'board_id');
    }
    public function articles()
    {
        return $this->hasMany(KBArticle::class, 'category_id');
    }
    public function children()
    {
        return $this->hasMany(KBCategory::class, 'parent_id');
    }
    public function totalArticlesCount()
    {
        $count = $this->articles ? $this->articles->count() : 0;

        foreach ($this->children as $child) {
            $count += $child->totalArticlesCount();
        }

        return $count;
    }

}
