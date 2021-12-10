<?php

namespace App\Repositories\Eloquents;

use App\Models\AdminPermission;
use App\Repositories\Contracts\AdminPermissionContract;
use Illuminate\Database\Eloquent\Model;


class AdminPermissionRepositoryEloquent extends BaseRepositoryEloquent implements AdminPermissionContract
{
    public function getModel(): Model
    {
        return new AdminPermission;
    }

    public function getIds()
    {
        return $this->getModel()->query()->pluck('id')->toArray();
    }

}
