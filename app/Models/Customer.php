<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'sap_id',
        'email',
        'phones',
        'sale_org',
        'company',
        'other_name',
    ];

    protected $filterable = [
        'sap_id',
    ];
    protected $filterLike = [
        'name',
        'phones',
        'email',
        'other_name',
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
    public static function getTableName()
    {
        return (new self())->getTable();
    }

}
