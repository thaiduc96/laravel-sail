<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseWarehouseProvider extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'warehouse_id',
        'warehouse_provider_id',
    ];

    protected $filterable = [
        'warehouse_id',
        'warehouse_provider_id',
    ];
}
