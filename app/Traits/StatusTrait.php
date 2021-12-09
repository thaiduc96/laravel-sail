<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait StatusTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootStatusTrait()
    {
        self::creating(function (Model $model) {
            if ($model->status == STATUS_ACTIVE) {
                $model->status = STATUS_ACTIVE;
            } else {
                $model->status = STATUS_INACTIVE;
            }
        });

        self::updating(function (Model $model) {
            if ($model->status == STATUS_ACTIVE) {
                $model->status = STATUS_ACTIVE;
            } else {
                $model->status = STATUS_INACTIVE;
            }
        });
    }
}
