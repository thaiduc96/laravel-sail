<?php

namespace App\Repositories\Eloquents;

use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use App\Repositories\Contracts\BaseContract;

abstract class BaseRepositoryEloquent implements BaseContract
{
    /** @var \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Eloquent\QueryBuilder **/
    protected $model;

    /**
     * Limit for pagination
     */
    protected $limit = 10;

    public function __construct()
    {
        $this->model = $this->getModel();
    }

    /**
     * Function to get model. Must be implemented in child class.
     * E.g: return new Post;
     */
    abstract public function getModel(): Model;

    public function withRelationship()
    {
        return [];
    }

    public function with($relationship)
    {
        return $this->model->with(is_array($relationship) ? $relationship : [$relationship]);
    }

    /**
     * Execute the query as a "select" statement.
     *
     * @param  array|string  $columns
     * @return \Illuminate\Database\Eloquent\Collection[]
     */
    public function filter($condition = [],$with = [], $columns = ['*'], $query = null)
    {
        $query = $query ?? $this->model;

        if(!empty($with)){
            $query = $query->with($with);
        }

        $query = $query->orderBy($condition['order_by'] ?? $this->model->defaultOrderBy, $condition['order_direction'] ?? $this->model->defaultOrderDirection);

        $query = $query->filter($condition);

        if(isset($condition['limit']) OR isset($condition['page']) ){
            return $query->paginate($condition['limit'] ?? $this->limit);
        }else{
            return $query->get();
        }
    }

    /**
     * Find a model by its primary key.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model|\Illuminate\Database\Eloquent\Collection[]|null
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model::find($id, $columns);
    }

    public function findOrFail($id, $columns = ['*'])
    {
        return $this->model::findOrFail($id,$columns);
    }

    public function findByCondition($condition, $columns = ['*'])
    {
        return $this->model::filter($condition)->first($columns);
    }

    /**
     * Find a model by its primary key or return fresh model instance.
     *
     * @param  mixed  $id
     * @param  array  $columns
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findOrNew($id, $columns = ['*'])
    {
        return $this->model::firstOrNew($id, $columns);
    }

    /**
     * Get the first record matching the attributes or create it.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->model::firstOrCreate($attributes, $values);
    }

    /**
     * Save a new model and return the instance.
     *
     * @param array $data
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function create(array $data)
    {
        return $this->model::create($data);
    }

    public function createMultiple(array $data)
    {
        DB::beginTransaction();
        try {
            foreach ($data as $datum) {
                $this->model->create($datum);
            }
            DB::commit();

            return true;
        } catch (Exception $ex) {
            DB::rollback();

            return false;
        }

    }

    /**
     * Update a record in the database.
     *
     * @param \Illuminate\Database\Eloquent\Model|string|integer $model
     * @param array $values
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function update($model, array $data)
    {
        $db = $model instanceof Model ? $model : $this->model::withTrashed()->find($model);
        if ($db) {
            $db->fill($data)->save();

            return $db;
        }

        return $db;
    }

    public function updateByCondition($conditions, array $data)
    {
        return $this->model::filter($conditions)->update($data);
    }


    /**
     * Create or update a record matching the attributes, and fill it with values.
     *
     * @param  array  $attributes
     * @param  array  $values
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function updateOrCreate(array $attributes, array $values = [])
    {
        return $this->model::updateOrCreate($attributes, $values);
    }

    /**
     * Update records from the database by conditions.
     * @param array $condition
     * @param array $update
     *
     * @return mixed
     */
    public function updateByConditions(array $condition, array $update)
    {
        return $this->model->filter($condition)->update($update);
    }

    /**
     * Delete a record from the database by id.
     * @param string|int|Model $id
     *
     * @return mixed
     */
    public function delete($id)
    {
        $model = $id;
        if (!($id instanceof Model)) {
            $model = $this->find($id);
        }

        return $model->delete();
    }

    /**
     * Delete records from the database by conditions.
     * @param array $condition
     *
     * @return mixed
     */
    public function deleteByConditions(array $condition)
    {
        return $this->model->where($condition)->delete();
    }

    public function recovery($model)
    {
        $model = $model instanceof Model ? $model :  $this->model->withTrashed()->find($model);
        if ($model !== null) {
            $model->restore();
            return true;
        } else {
            return false;
        }
    }

    /**
     * Get data from db by slug or id
     * @param int|string $term
     *
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function getBySlugId($term)
    {
        return $this->model
            ->where('id', $term)
            ->orWhere('slug', $term)
            ->with($this->withRelationship())
            ->first();
    }

    public function datatables($condition = [])
    {
        return $this->model->select("*")->filter($condition);
    }

    public function count($condition = [])
    {
        return $this->model->filter($condition)->count();
    }

    public function options($condition = [], $column = ['id', 'name'], $query = null)
    {
        if (isset($condition['columns'])) {
            $column = $condition['columns'];
        }

        $query = $query ?? $this->model;
        $query = $query->orderBy($condition['order_by'] ??  $this->model->defaultOrderByOption, $condition['order_direction'] ?? 'asc');

        if(isset($condition['limit']) OR isset($condition['page']) ){
            return $query->filter($condition)->select($column)->paginate($condition['limit'] ?? $this->limit);
        }else{
            return $query->filter($condition)->select($column)->get();
        }
    }

    protected function whereLike($query, $fields, $value)
    {
        if (!$fields) {
            return $query;
        }
        if (is_string($fields)) {
            return $query->where($fields, 'ILIKE', "%$value%");
        }
        if (is_array($fields)) {
            $query = $query->where(function ($q) use ($fields, $value) {
                foreach ($fields as $field) {
                    $q->orWhere($field, 'ILIKE', "$$value%");
                }
            });

            return $query;
        }
    }
}
