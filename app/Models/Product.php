<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Product extends Model
{
    //
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
    public function color()
    {
        return $this->belongsToMany(Color::class)->withTimestamps();
    }
    public function size()
    {
        return $this->belongsToMany(Size::class)->withTimestamps();
    }
    public function admin()
    {
        return $this->belongsTo(User::class,'creator');
    }


    public function firstImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imagable')->orderBy('file_sort', 'asc');
    }
    public function ndImage(): MorphOne
    {
        return $this->morphOne(Image::class, 'imagable')->orderBy('file_sort', 'desc');
    }
    public function image(): MorphMany
    {
        return $this->MorphMany(Image::class, 'imagable')->where('file_nametype','products_images');
    }


    public static function scopeActive($query)
    {
        return $query->where('status', 1);
    }
}

