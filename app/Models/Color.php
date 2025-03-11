<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $guarded = [];

    public function related_products()
    {
        return $this->belongsToMany(Product::class);
    }
}
