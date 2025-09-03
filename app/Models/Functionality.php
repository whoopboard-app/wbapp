<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ChangelogTag;
class Functionality extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'status'];
    public function tags()
    {
        return $this->belongsToMany(ChangelogTag::class, 'functionality_tag');
    }
}
