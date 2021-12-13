<?php 


namespace App\Services;

use App\Repositories\Facades\ProviderRepository;
use Illuminate\Database\Eloquent\Model;

class ProviderService
{
    public function filter($filter)
    {
        $list = ProviderRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $res = ProviderRepository::create($data);
        return $res;
    }

    public function find($id)
    {
        $res = ProviderRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = ProviderRepository::findOrFail($id);
        $res = ProviderRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : ProviderRepository::find($model);
        return ProviderRepository::delete($model);
    }

    public function recovery($model)
    {
        return ProviderRepository::recovery($model);
    }
}
        