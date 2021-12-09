<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

trait UserUpdateTrait
{
    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function bootUserUpdateTrait()
    {
        self::creating(function (Model $model) {
            if (empty($model->updated_by)) {
                $model->updated_by = Auth::id() ?? null;
            }
        });
    }
}
