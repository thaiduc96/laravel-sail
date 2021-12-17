<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Provider extends Base
{
    use HasFactory;
    use Filterable;
    use StatusTrait;

    public $defaultOrderBy = 'name';
    public $defaultOrderByOption = 'name';
    public $defaultOrderDirection = 'asc';

    protected $fillable = [
        'sap_id',
        'name',
        'status',
        'sap_phone',
        'phones',
    ];

    protected $filterable = [
        'status',
        'sap_id',
    ];

    protected $filterLike = [
        'name',
        'sap_phone',
        'phones',
    ];

    protected $casts = [
        'phones' => 'array'
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

    public function filterNames($query, $value)
    {
        if (empty($value)) return $query;
        return $query->whereIn('name', $value);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function filterSearch($query, $value)
    {
        if (empty($value)) return $query;
        return $query->where(function ($q) use ($value){
            $q->where('name', 'ILIKE', "%" . $value . "%")
            ;
        });
    }
}
