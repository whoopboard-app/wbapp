<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $table = 'tenants';
    protected $primaryKey = 'tenant_id';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'subdomain',
        'client_full_name',
        'status',
        'subscription_status',
        'product_goals',
        'custom_url',
        'page_publish',
        'client_user_id',
        'date_of_registration',
        'time_of_registration',
        'data',
        'website_url',
    ];
    protected $casts = [
        'product_goals' => 'array',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'tenant_id', 'tenant_id');
    }

    public function planTransactions()
    {
        return $this->hasMany(PlanTransaction::class, 'tenant_id', 'tenant_id');
    }
    public function userTheme()
    {
        return $this->hasOne(UserTheme::class, 'tenant_id', 'tenant_id');
    }
}
