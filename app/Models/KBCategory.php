<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBCategory extends Model
{
    use HasFactory;
    protected $with = ['articles', 'children.articles', 'children.children.articles'];
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

    /**
     * 🔹 A category may have multiple subcategories (children)
     */
    public function children()
    {
        return $this->hasMany(self::class, 'parent_id');
    }

    /**
     * 🔹 Recursive relationship for nested children (multi-level)
     */
    public function childrenRecursive()
    {
        return $this->hasMany(self::class, 'parent_id')
            ->with(['articles', 'childrenRecursive']);
    }

    /**
     * 🔹 A category may belong to a parent category
     */
    public function parent()
    {
        return $this->belongsTo(self::class, 'parent_id');
    }

    /**
     * 🔹 A category belongs to a board
     */
    public function board()
    {
        return $this->belongsTo(KBBoard::class, 'board_id');
    }

    /**
     * 🔹 A category can have multiple articles
     */
    public function articles()
    {
        return $this->hasMany(KBArticle::class, 'category_id');
    }

    /**
     * 🔹 Get total article count including subcategories (recursive)
     */
    public function totalArticlesCount()
    {
        $count = $this->articles ? $this->articles->count() : 0;

        foreach ($this->children as $child) {
            $count += $child->totalArticlesCount();
        }

        return $count;
    }
    public function getTotalArticlesCountAttribute()
    {
        $count = $this->articles ? $this->articles->count() : 0;

        foreach ($this->children as $child) {
            $count += $child->total_articles_count; // recursive call to accessor
        }

        return $count;
    }

    public function allDescendantsCount(): int
    {
        $count = $this->children->count();
        foreach ($this->children as $child) {
            $count += $child->allDescendantsCount();
        }
        return $count;
    }

    // Accessor
    public function getAllDescendantsCountAttribute(): int
    {
        return $this->allDescendantsCount();
    }
}
