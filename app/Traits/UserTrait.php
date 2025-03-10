<?php

namespace App\Traits;

trait UserTrait
{
    public static function bootUserTrait()
    {
        if (auth()->check()) {

            static::creating(function ($model) {
                $model->user_id = auth()->user()->id;
                $model->last_update = auth()->user()->id;
            });

            static::updating(function ($model) {
                $model->last_update = auth()->user()->id;
            });
        }
    }
}
