<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SettingCategoryChangelog extends Model
{
    protected $table = 'setting_category_changelog';

    protected $fillable = [
        'tenant_id',
        'category_name',
        'color_hex',
        'status',
    ];
}
