<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Base extends Model
{
    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $defaultOrderBy = 'created_at';
    public $defaultOrderByOption = 'name';
    public $defaultOrderDirection = 'desc';

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ('string' === $model->keyType && !$model->id) {
                $model->id = (string)Str::uuid();
            }
        });
    }
}
