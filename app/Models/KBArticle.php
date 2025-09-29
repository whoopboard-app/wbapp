<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KBArticle extends Model
{
    use HasFactory;

    protected $table = 'kb_articles';

    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'category_id',
        'show_widget',
        'link_changelog',
        'author',
        'popular_article',
        'list_order',
        'tag_ids',
        'other_article_category',
        'other_article_category2',
        'status',
        'article_banner',
        'action',
    ];

    protected $casts = [
        'author' => 'array',
        'tags' => 'array',
        'other_article_category' => 'integer',
        'other_article_category2' => 'integer',
        'show_widget' => 'boolean',
        'popular_article' => 'boolean',
    ];

    /**
     * Tenant relation (assuming tenants table exists).
     */
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
    public function category()
    {
        return $this->belongsTo(KBCategory::class, 'category_id', 'id');
    }

    public function board()
    {
        // article → category → board
        return $this->hasOneThrough(KBBoard::class, KBCategory::class, 'id', 'id', 'category_id', 'board_id');
    }
    public function tags()
    {
        return $this->hasMany(ChangelogTag::class, 'id', 'tag_ids');
    }
    public function getTagListAttribute()
    {
        $ids = $this->tag_ids ? explode(',', $this->tag_ids) : [];
        return ChangelogTag::whereIn('id', $ids)->get();
    }
}
