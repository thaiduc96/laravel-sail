<?php

namespace App\Repositories\Contracts;

interface BaseContract
{
    public function getModel();

    public function filter($condition = [], $with = []);

    public function find($id);

    public function findOrFail($id, $columns = ['*']);

    public function findByCondition($conditions, $columns = ['*']);

    public function findOrNew($id, $columns = ['*']);

    public function firstOrCreate(array $attributes, array $values = []);

    public function create(array $data);

    public function update($id, array $data);

    public function updateByCondition($conditions, array $data);

    public function updateOrCreate(array $attributes, array $values = []);

    public function delete($model);

    public function recovery($model);

    public function deleteByConditions(array $conditions);

    public function datatables($conditions = []);

    public function count($conditions = []);

    public function options($conditions = [], $column = ['id', 'name'], $query = null);
}
