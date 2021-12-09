<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\StatusTrait;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warehouse extends Base
{
    use SoftDeletes;
    use Filterable;
    use StatusTrait;

    protected $fillable = [
        'code',
        'name',
        'address',
        'ward_id',
        'district_id',
        'province_id',
        'status'
    ];

    protected $filterable = [
        'status',
        'ward_id',
        'district_id',
        'province_id',
    ];

    protected $filterLike = [
        'code', 'name'
    ];

    public function filterSearch($query, $value)
    {
        if (empty($value)) return $query;
        return $query->where(function ($q) use ($value){
            $q->where('code', 'ILIKE', "%" . $value . "%")
                ->orWhere('name', 'ILIKE', "%" . $value . "%")
            ;
        });
    }

    public function filterUnused($query, $value)
    {
        if (empty($value)) return $query;
        return $query->doesnthave('branch');
    }

    public function filterInCodes($query, $value)
    {
        if (empty($value)) return $query;
        return $query->whereIn('code', $value);
    }

    public function filterNotInCodes($query, $value)
    {
        if (empty($value)) return $query;
        return $query->whereNotIn('code', $value);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function ward(): BelongsTo
    {
        return $this->belongsTo(Ward::class,'ward_id','id');
    }

    public function district(): BelongsTo
    {
        return $this->belongsTo(District::class,'district_id','id');
    }

    public function province(): BelongsTo
    {
        return $this->belongsTo(Province::class,'province_id','id');
    }


    public function warehouseProducts(): HasMany
    {
        return $this->hasMany(WarehouseProduct::class, 'warehouse_id', 'id');
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'warehouse_products', 'warehouse_id', 'product_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            })
            ->withPivot('quantity');
    }
}
