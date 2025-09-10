<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserTheme extends Model
{
    protected $fillable = [
        'user_id',
        'theme_id',
        'brand_color',
        'page_title',
        'welcome_message',
        'short_description',
        'module_labels',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'google_analytics',
        'is_visible',
        'is_password_protected',
        'password',
    ];

    protected $casts = [
        'module_labels' => 'array',
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }
}
