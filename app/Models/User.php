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
        'short_desc',
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
/*        Smtp::firstOrCreate([
            'provider_name' => config('mail.mailers.smtp.host'),
            'username'      => config('mail.mailers.smtp.username'),
        ]);*/
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



    public function userTypeLabel()
    {
        return match((int) $this->user_type) {
            1 => 'Super Administrator',
            2 => 'Administrator',
            3 => 'Manager',
            4 => 'Editor',
            5 => 'User',
            default => 'Other',
        };
    }
    public function onboarding()
    {
        return $this->hasOne(UserOnboarding::class, 'user_id', 'id');
    }

}
