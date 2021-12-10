<?php

namespace App\Repositories\Eloquents;

use App\Models\AdminGroupPermission;
use App\Repositories\Contracts\AdminGroupPermissionContract;
use Illuminate\Database\Eloquent\Model;


class AdminGroupPermissionRepositoryEloquent extends BaseRepositoryEloquent implements AdminGroupPermissionContract
{
    public function getModel(): Model
    {
        return new AdminGroupPermission;
    }

    public function getPermissionIds($groupId)
    {
        return $this->getModel()->query()
            ->where('admin_group_id', $groupId)
            ->distinct()->pluck('admin_permission_id')->toArray();
    }
}
