<?php
/**
 * Created by PhpStorm.
 * User: thai duc
 * Date: 12-04-21
 * Time: 6:39 PM
 */

namespace App\Traits;

use Illuminate\Support\Str;

trait Filterable
{
    public function scopeFilter($query, $param)
    {
        foreach ($param as $field => $value) {
            $method = 'filter' . Str::studly($field);

            if (empty($value) or $value === '' or $value === null) {
                continue;
            }

            if (method_exists($this, $method)) {
                $this->{$method}($query, $value);
                continue;
            }

            if (empty($this->filterable) || !is_array($this->filterable)) {
                continue;
            }

            if (in_array($field, $this->filterable)) {
                $query->where($this->getTable() . '.' . $field, $value);
                continue;
            }

            if (!empty($this->filterLike) && in_array($field, $this->filterLike)) {
                $query->where($this->getTable() . '.' . $field, 'ILIKE', "%" . $value . "%");
                continue;
            }
            if (key_exists($field, $this->filterable)) {
                $query->where($this->getTable() . '.' . $this->filterable[$field], $value);
                continue;
            }
        }

        return $query;
    }

    public function filterWithTrashed($query, $value)
    {
        if (filter_var($value, FILTER_VALIDATE_BOOLEAN)) {
            return $query->withTrashed();
        }
        return $query;
    }


}
