<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TenantSegmentField extends Model
{
    protected $table = 'tenant_segment_fields';

    protected $fillable = [
        'tenant_id',
        'segment_field_id',
        'option_name',
        'status',
    ];

    // Relationships
    public function tenant()
    {
        return $this->belongsTo(Tenant::class, 'tenant_id', 'tenant_id');
    }

    public function segmentField()
    {
        return $this->belongsTo(SegmentField::class, 'segment_field_id', 'id');
    }
}
