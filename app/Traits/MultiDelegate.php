<?php

namespace App\Traits;

use App\Models\Driver;
use App\Models\Truck;
use Illuminate\Database\Eloquent\Builder;

trait MultiDelegate
{
    public static function bootMultiDelegate()
    {
        if (auth()->check()) {
            if (auth()->user()->delegate_id) {
                static::creating(function ($model) {
                    $model->delegate_id = auth()->user()->delegate_id;
                });
                static::addGlobalScope('delegate_id', function (Builder $builder) {
                    return $builder->where('delegate_id', auth()->user()->delegate_id);
                });

            }
        }
    }
}
