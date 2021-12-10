<?php 


namespace App\Services;

use App\Repositories\Facades\MenuRepository;
use Illuminate\Database\Eloquent\Model;

class MenuService
{
    public function filter($filter)
    {
        $list = MenuRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = MenuRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = MenuRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = MenuRepository::findOrFail($id);
        $res = MenuRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : MenuRepository::find($model);
        return MenuRepository::delete($model);
    }

    public function recovery($model)
    {
        return MenuRepository::recovery($model);
    }
}
        