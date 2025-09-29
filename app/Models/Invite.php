<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invite extends Model
{
    public const SUPER_ADMIN = 1;
    public const ADMIN       = 2;
    public const MANAGER     = 3;
    public const EDITOR      = 4;
    public const USER        = 5;
    protected $fillable = ['first_name', 'email', 'user_type', 'token' , 'invited_by_tenant' , 'invited_by_user', 'status'];

    public static function userTypeLabels(): array
    {
        return [
            self::SUPER_ADMIN => 'Super Administrator',
            self::ADMIN       => 'Administrator',
            self::MANAGER     => 'Manager',
            self::EDITOR      => 'Editor',
            self::USER        => 'User',
        ];
    }

     // Get label for current user
    public function userTypeLabel(): string
    {
        return self::userTypeLabels()[$this->user_type] ?? 'Other';
    }

    // Helper to check if user is super admin
    public function isSuperAdmin(): bool
    {
        return $this->user_type === self::SUPER_ADMIN;
    }
}
