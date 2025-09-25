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
        'tags',
        'other_article_category',
        'other_article_category2',
        'status',
        'article_banner',
        'action',
    ];

    protected $casts = [
        'category' => 'array',
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
}
