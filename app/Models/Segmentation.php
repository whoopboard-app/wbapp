<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Segmentation extends Model
{
    protected $fillable = [
        'name',
        'short_desc',
        'status',
        'revenue_range_id',
        'location_id',
        'age_id',
        'gender_id',
        'language_id',
        'role_id',
        'plan_type',
        'engagement_id',
        'frequency_id',
        'signup_date',
    ];

    public function revenueRange()
    {
        return $this->belongsTo(GenericValue::class, 'revenue_range_id');
    }

    public function location()
    {
        return $this->belongsTo(GenericValue::class, 'location_id');
    }

    public function age()
    {
        return $this->belongsTo(GenericValue::class, 'age_id');
    }

    public function gender()
    {
        return $this->belongsTo(GenericValue::class, 'gender_id');
    }

    public function language()
    {
        return $this->belongsTo(GenericValue::class, 'language_id');
    }

    public function role()
    {
        return $this->belongsTo(GenericValue::class, 'role_id');
    }

    public function engagement()
    {
        return $this->belongsTo(GenericValue::class, 'engagement_id');
    }

    public function frequency()
    {
        return $this->belongsTo(GenericValue::class, 'frequency_id');
    }

    public function planTypes()
    {
        if (!$this->plan_type) return collect();

        $ids = explode(',', $this->plan_type);
        return GenericValue::whereIn('id', $ids)->get();
    }
}
