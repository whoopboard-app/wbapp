<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'client_full_name',
        'status',
        'subscription_status',
        'client_user_id',
        'date_of_registration',
        'time_of_registration',
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
