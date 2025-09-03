<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Functionality;

class ChangelogTag extends Model
{
    protected $fillable = ['tenant_id','tag_name','functionality_group', 'short_description'];

    public function functionalities()
    {
        return $this->belongsToMany(Functionality::class, 'functionality_tag');
    }
}
