<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Inventory extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'product_id',
        'provider_id',
        'warehouse_provider_id',
        'quantity',
    ];

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function warehouseProvider(): BelongsTo
    {
        return $this->belongsTo(WarehouseProvider::class, 'warehouse_provider_id', 'id');
    }
}
