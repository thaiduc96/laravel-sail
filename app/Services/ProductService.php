<?php 


namespace App\Services;

use App\Repositories\Facades\ProductRepository;
use Illuminate\Database\Eloquent\Model;

class ProductService
{
    public function filter($filter)
    {
        $list = ProductRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = ProductRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = ProductRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = ProductRepository::findOrFail($id);
        $res = ProductRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : ProductRepository::find($model);
        return ProductRepository::delete($model);
    }

    public function recovery($model)
    {
        return ProductRepository::recovery($model);
    }
}
        