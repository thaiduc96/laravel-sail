<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\StatusTrait;
use App\Traits\UserCreateTrait;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Base
{
    use SoftDeletes;
    use Filterable;
    use StatusTrait;
    use UserCreateTrait;

    protected $fillable = [
        'code',
        'name',
        'created_by',
        'status',
        'sap_id',
        'origin',
    ];

    protected $filterable = [
        'status',
        'created_by',
        'sap_id',
    ];

    protected $filterLike = [
        'code',
        'name',
    ];

    public function filterNotInSap($query, $value)
    {
        if (empty($value)) return $query;
        return $query->whereNotIn('sap_id', $value);
    }

    public function filterInSap($query, $value)
    {
        if (empty($value)) return $query;
        return $query->whereIn('sap_id', $value);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function createdByAdmin(): BelongsTo
    {
        return $this->belongsTo(Admin::class, 'created_by', 'id');
    }

    public function warehouses(): BelongsToMany
    {
        return $this->belongsToMany(Warehouse::class, 'warehouse_products', 'product_id', 'warehouse_id')
            ->withPivot('quantity');
    }
}
