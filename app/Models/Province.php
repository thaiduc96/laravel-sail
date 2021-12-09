<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class Province extends Base
{
    use Filterable;

    public $incrementing = false;
    public $timestamps = false;

    public static function getTableName()
    {
        return (new self())->getTable();
    }


    protected $fillable = [
        'name',
        'slug',
        'type',
        'name_with_type',
        'region',
    ];

    protected $filterable = [
        'name',
        'slug',
        'type',
        'name_with_type',
        'region',
    ];
}
