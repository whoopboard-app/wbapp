<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GlobalProduct extends Model
{
    protected $table = 'global_products';
    protected $fillable = ['name', 'status'];
}
