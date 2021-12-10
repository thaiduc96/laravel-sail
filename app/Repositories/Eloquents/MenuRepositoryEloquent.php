<?php

namespace App\Repositories\Eloquents;

use App\Models\Menu;
use App\Repositories\Contracts\MenuContract;
use Illuminate\Database\Eloquent\Model;


class MenuRepositoryEloquent extends BaseRepositoryEloquent implements MenuContract
{
    public function getModel(): Model
    {
        return new Menu;
    }

    public function getByAdminPermissionIds($adminPermissionIds){
        return Menu::query()->with(['permissions' => function($q) use ($adminPermissionIds){
            $q->whereIn('admin_permissions.id', $adminPermissionIds);
        }])
            ->whereHas('permissions', function($q) use ($adminPermissionIds){
                $q->whereIn('admin_permissions.id', $adminPermissionIds);
            })
            ->orWhere('menus.key_authority', MENU_DASHBOARD)
            ->get();
    }
}
