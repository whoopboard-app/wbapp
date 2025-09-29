<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    protected $fillable = ['first_name', 'email', 'user_type', 'token' , 'invited_by_tenant' , 'invited_by_user', 'status'];

    public function userTypeLabel()
    {
        return match($this->user_type) {
            1 => 'Super Administrator',
            2 => 'Administrator',
            3 => 'Manager',
            4 => 'Editor',
            5 => 'User',
            default => 'Other',
        };
    }

    // Helper to check if user is super admin
    public function isSuperAdmin(): bool
    {
        return $this->user_type === self::SUPER_ADMIN;
    }
}
