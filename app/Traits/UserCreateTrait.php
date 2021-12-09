<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait UserCreateTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootUserCreateTrait()
    {
        self::creating(function (Model $model) {
            if (empty($model->created_by)) {
                $model->created_by = Auth::id() ?? null;
            }
        });
    }
}
