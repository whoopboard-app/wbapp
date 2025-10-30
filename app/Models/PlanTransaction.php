<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlanTransaction extends Model
{
    // Specify the table name if it doesn't follow Laravel convention
    protected $table = 'plan_transactions';

    // Fields that are mass assignable
    protected $fillable = [
        'user_id',
        'tenant_id',      // add this
        'plan_id',
        'invoice_number',
        'transaction_date',
        'transaction_id',
        'payment_type',
        'amount',
        'status',         // add this
        'next_due_date',
    ];
    // Optional: disable timestamps if your table doesn't use created_at / updated_at
    // public $timestamps = false;

    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }

    public function membershipPlan()
    {
        return $this->belongsTo(MembershipPlan::class, 'plan_id', 'id');
    }
}
