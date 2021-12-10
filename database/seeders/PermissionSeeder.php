<?php

namespace Database\Seeders;

use App\Models\AdminPermission;
use App\Models\Menu;
use App\Models\MenuPermission;
use App\Repositories\Facades\MenuPermissionRepository;
use App\Repositories\Facades\MenuRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use function Illuminate\Events\queueable;

class PermissionSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->insertOtherService();
        MenuPermission::query()->forceDelete();
        $permissions = AdminPermission::all();
        $menus = Menu::all();
        $menus = $menus->keyBy('key_authority');
        foreach($permissions as $permission){
            if(is_string($permission->menus)){
                $permission->menus = json_decode($permission->menus);
            }
            foreach($permission->menus as $keyAuthorMenu){
                if(!empty($menus[$keyAuthorMenu])){
                    $menu = $menus[$keyAuthorMenu];
                    MenuPermissionRepository::firstOrCreate([
                       'menu_id' => $menu->id,
                       'admin_permission_id' => $permission->id
                    ]);
                }else{
                    dump($keyAuthorMenu);
                }
            }
        }
    }

    public function handleUpdate($data){
        foreach($data as $item){
            AdminPermission::updateOrCreate([
                'key_authority' => $item['key_authority']
            ],$item);
        }
    }

    private function insertOtherService(){
       $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách dịch vụ khác',
                'group_name' => 'Dịch vụ khác',
                'route_name' => 'AdminApi.other-services.index::',
                'key_authority' => 'other_service_list',
                'menus' => json_encode(
                    [
                        'other_service_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo Dịch vụ khác',
                'group_name' => 'Dịch vụ khác',
                'route_name' => 'AdminApi.other-services.store::',
                'key_authority' => 'other_service_form_create',
                'menus' => json_encode(
                    [
                        'other_service_list',
                        'other_service_form_create',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa Dịch vụ khác',
                'group_name' => 'Dịch vụ khác',
                'route_name' => 'AdminApi.other-services.update::',
                'key_authority' => 'other_service_form_edit',
                'menus' => json_encode(
                    [
                        'other_service_list',
                        'other_service_form_edit',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá Dịch vụ khác',
                'group_name' => 'Dịch vụ khác',
                'route_name' => 'AdminApi.other-services.destroy::',
                'key_authority' => 'other_service_destroy',
                'menus' => json_encode(
                    [
                        'other_service_list'
                    ]
                )
            ],
        ]);
    }


}
