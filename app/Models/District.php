<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Model;

class District extends Model
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
        'path',
        'path_with_type',
        'province_id',
    ];

    protected $filterable = [
        'name',
        'slug',
        'type',
        'name_with_type',
        'path',
        'path_with_type',
        'province_id',
    ];

    public function filterNameOrSlug($query, ...$value)
    {
        if (empty($value)) return $query;
        return $query->where(function ($q) use ($value){
            $q->where($this->getTable() . '.name', 'ILIKE', "%" . $value . "%")
                ->orWhere($this->getTable() . '.slug', 'ILIKE', "%" . $value . "%");
        });
    }
}
