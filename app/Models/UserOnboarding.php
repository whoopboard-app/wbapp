<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserOnboarding extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'main_goal',
        'functionalities',
        'product_name',
        'current_url',
        'custom_domain',
        'full_name',
        'completed',
    ];

    protected $casts = [
        'functionalities' => 'array', // automatically cast JSON to array
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
