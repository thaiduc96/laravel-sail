<?php


namespace App\Services;

use App\Repositories\Facades\AdminGroupPermissionRepository;
use App\Repositories\Facades\AdminGroupRepository;
use App\Repositories\Facades\AdminPermissionRepository;
use App\Repositories\Facades\MenuRepository;
use Illuminate\Database\Eloquent\Model;

class AdminPermissionService
{

    /*
     * Nếu là super_admin thì lấy hết
     */
    public function handleDataPermission($admin){
        $adminGroup = $admin->adminGroup;
        $adminGroupId = $adminGroup->id;

        /*
         * Lấy ra các quyền hiện tại của user
         */
        if($adminGroup->key == SUPER_ADMIN){
            $adminPermissionIds = AdminPermissionRepository::getIds();
        }else{
            $adminPermissionIds = AdminGroupPermissionRepository::getPermissionIds($adminGroupId);
        }

        /*
         * Lấy ra các menu mà có dùng đến các quyền ở trên
         */
        $menus = MenuRepository::getByAdminPermissionIds($adminPermissionIds);

        $array = [];
        foreach($menus as $menu) {
            /*
             * Nếu chức năng k có trên menu (
             */
            $operation = [];
            /*
             * Thêm các quyền có của menu vào array quyền
             * Đồng thời kiểm tra nếu quyền của user hiện tại có trên menu
             */
            $permissionMenu = false;
            foreach ($menu->permissions as $permission) {
                $operation [] = $permission->key_authority;
                if ($permission->key_authority == $menu->key_authority) {
                    $permissionMenu = true;
                }elseif($menu->key_authority == MENU_DASHBOARD){
                    $permissionMenu = true;
                }
            }

            /*
             * Id của menu. chỉ thêm vào nếu 1 quyền có trên menu
             * Hoặc menu là menu dashboard
             */
            if ($permissionMenu) {
                /*
                 * Kiểm tra nếu menu cấp 1 chưa được thêm vào thì thêm
                 */
                $parentKey = $menu->parent_key_authority;
                $parentExists = array_filter($array, function ($var) use ($parentKey) {
                    return ($var['id'] == $parentKey);
                });
                if(empty($parentExists)){
                    $array [] =[
                        'id' => $parentKey
                    ];
                }

                $item = [
                    'id' => $menu->key_authority
                ];
                /*
                 * Nếu có quyền cho menu thì thêm vào
                 */
                if(!empty($operation)){
                    $item['operation'] = $operation;
                }
                /*
                 * Thêm menu vào danh sách menu
                 */
                $array[] = $item;
            }
        }

        $menuDashboard = array_filter($array, function ($var){
            return ($var['id'] == MENU_DASHBOARD);
        });
        if(empty($menuDashboard)){
            $array [] =[
                'id' => MENU_DASHBOARD
            ];
        }

        return $array;
    }

    public function filter($groupId,$filter)
    {
        $selectedPermission = AdminGroupPermissionRepository::getPermissionIds($groupId);
        $list = AdminPermissionRepository::filter($filter,null,['id','name','group_name']);
        $arr = [];
        foreach($list as $item){
            $arr[$item->group_name][] = [
                'id' => $item->id,
                'name' => $item->name,
                'is_selected' => in_array($item->id,$selectedPermission)
            ];
        }
        return [
            'permissions' => $arr,
            'permission_ids' => $selectedPermission
        ];
    }

    public function update($groupId, $data)
    {
        $group = AdminGroupRepository::find($groupId);
        return $group->adminPermissions()->sync($data);
    }

}
