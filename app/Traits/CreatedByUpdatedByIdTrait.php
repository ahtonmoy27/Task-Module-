<?php

namespace App\Traits;

use Illuminate\Support\Facades\Schema;

trait CreatedByUpdatedByIdTrait
{
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'created_by_id')) {
                $model->created_by_id = auth()->id();
            }
        });

        static::updating(function ($model) {
            if (Schema::hasColumn($model->getTable(), 'updated_by_id')) {
                $model->updated_by_id = auth()->id();
            }
        });
    }
}
