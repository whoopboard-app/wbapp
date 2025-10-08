<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; // ✅ important
use Illuminate\Notifications\Notifiable;


class Admin extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'first_name', 'last_name', 'email', 'user_type', 'status', 'password',
    ];

    protected $hidden = [
        'password',
    ];

}
