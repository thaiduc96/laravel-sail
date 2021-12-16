<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class WarehouseProvider extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'provider_id',
        'description',
    ];

    protected $filterLike = [
        'name', 'description'
    ];


    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function filterSearch($query, $value)
    {
        if (empty($value)) return $query;
        return $query->where(function ($q) use ($value) {
            $q->where('name', 'ILIKE', "%" . $value . "%")
                ->orWhere('description', 'ILIKE', "%" . $value . "%");
        });
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function warehouseWarehouseProviders(): HasMany
    {
        return $this->hasMany(WarehouseWarehouseProvider::class, 'warehouse_provider_id', 'id');
    }

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_warehouse_providers', 'warehouse_provider_id', 'warehouse_id')
        ->using(new class extends Pivot {
            use UuidTrait;
        });
    }

}
