<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Notifications\VerifyEmailWithCode;
use Illuminate\Support\Str;
use App\Models\Smtp;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;
    // User type constants
        public const SUPER_ADMIN = 1;
        public const ADMIN       = 2;
        public const MANAGER     = 3;
        public const EDITOR      = 4;
        public const USER        = 5;
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'password',
        'timezone',
        'user_type',
        'status',
        'tenant_id',
        'invited',
        'profile_img',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'verify_code_expire_at' => 'datetime',
            'invited' => 'boolean',
        ];
    }

    public function sendEmailVerificationNotification()
    {
        $this->generateVerifyCode();
        Smtp::firstOrCreate([
            'provider_name' => config('mail.mailers.smtp.host'),
            'username'      => config('mail.mailers.smtp.username'),
        ]);
        $this->notify(new VerifyEmailWithCode());
    }

    public function isVerifyCodeExpired(): bool
    {
        return $this->verify_code_expire_at !== null
            && now()->greaterThan($this->verify_code_expire_at);
    }

    public function clearVerifyCode(): void
    {
        $this->verify_code = null;
        $this->verify_code_expire_at = null;
        $this->save();
    }

    public function generateVerifyCode(int $hours = 24): void
    {
        $this->verify_code = random_int(100000, 999999);
        $this->verify_code_expire_at = now()->addHours($hours);
        $this->save();
    }
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }
    public function theme()
    {
        return $this->hasOne(UserTheme::class);
    }

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
