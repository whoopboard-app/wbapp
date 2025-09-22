<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Changelog extends Model
{
    use HasFactory;

    protected $fillable = [
        'tenant_id',
        'title',
        'description',
        'category',
        'feedback_request',
        'tags',
        'status',
        'publish_date',
        'show_widget',
        'send_email',
        'target_subscriber',
        'feature_banner',
    ];

    // Agar array fields ko JSON me save karna hai
    protected $casts = [
        'categorySelect' => 'array',
        'tagsSelect' => 'array',
        'show_widget' => 'boolean',
        'send_email' => 'boolean',
        'publishDate' => 'date',
    ];

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
}
