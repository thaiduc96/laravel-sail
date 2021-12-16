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
        $this->insertAdminGroup();
        $this->insertAdmin();
        $this->insertCustomer();
        $this->insertProvider();
        $this->insertProduct();
        $this->insertBranch();
        $this->insertOrder();
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

    private function insertOrder(){
       $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách đặt hàng',
                'group_name' => 'Đặt hàng',
                'route_name' => 'AdminApi.orders.index::',
                'key_authority' => 'order_list',
                'menus' => json_encode(
                    [
                        'order_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo đơn hàng',
                'group_name' => 'Đặt hàng',
                'route_name' => 'AdminApi.orders.store::',
                'key_authority' => 'order_form_create',
                'menus' => json_encode(
                    [
                        'order_list',
                        'order_form_create',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa đơn hàng',
                'group_name' => 'Đặt hàng',
                'route_name' => 'AdminApi.orders.update::',
                'key_authority' => 'order_form_edit',
                'menus' => json_encode(
                    [
                        'order_list',
                        'order_form_edit',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá đơn hàng',
                'group_name' => 'Đặt hàng',
                'route_name' => 'AdminApi.orders.destroy::',
                'key_authority' => 'order_destroy',
                'menus' => json_encode(
                    [
                        'order_list'
                    ]
                )
            ],
        ]);
    }

    private function insertBranch(){
        $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách kho Nanoco',
                'group_name' => 'Kho',
                'route_name' => 'AdminApi.warehouses.index::',
                'key_authority' => 'warehouse_list',
                'menus' => json_encode(
                    [
                        'warehouse_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách kho NCC',
                'group_name' => 'Kho',
                'route_name' => 'AdminApi.warehouse-providers.index::',
                'key_authority' => 'warehouse_provider_list',
                'menus' => json_encode(
                    [
                        'warehouse_provider_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo kho cho NCC',
                'group_name' => 'Kho',
                'route_name' => 'AdminApi.warehouse-providers.store::',
                'key_authority' => 'warehouse_provider_create',
                'menus' => json_encode(
                    [
                        'warehouse_provider_list',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa kho cho NCC',
                'group_name' => 'Kho',
                'route_name' => 'AdminApi.warehouse-providers.update::',
                'key_authority' => 'warehouse_provider_update',
                'menus' => json_encode(
                    [
                        'warehouse_provider_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá kho cho NCC',
                'group_name' => 'Kho',
                'route_name' => 'AdminApi.warehouse-providers.destroy::',
                'key_authority' => 'warehouse_provider_destroy',
                'menus' => json_encode(
                    [
                        'warehouse_provider_list'
                    ]
                )
            ],
        ]);
    }

    private function insertProduct(){
        $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách hàng hoá ',
                'group_name' => 'Sản phẩm',
                'route_name' => 'AdminApi.products.index::',
                'key_authority' => 'product_list',
                'menus' => json_encode(
                    [
                        'product_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sửa hàng hoá',
                'group_name' => 'Sản phẩm',
                'route_name' => 'AdminApi.products.update::',
                'key_authority' => 'product_update',
                'menus' => json_encode(
                    [
                        'product_list'
                    ]
                )
            ],
        ]);
    }

    private function insertProvider(){
        $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhà cung cấp',
                'group_name' => 'Nhà cung cấp',
                'route_name' => 'AdminApi.providers.index::',
                'key_authority' => 'provider_list',
                'menus' => json_encode(
                    [
                        'provider_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sửa nhà cung cấp',
                'group_name' => 'Nhà cung cấp',
                'route_name' => 'AdminApi.providers.update::',
                'key_authority' => 'provider_update',
                'menus' => json_encode(
                    [
                        'provider_list'
                    ]
                )
            ],
        ]);
    }

    private function insertCustomer(){
        $this->handleUpdate([

            [
                'id' => Str::uuid(),
                'name' => 'Danh sách khách hàng',
                'group_name' => 'Khách hàng',
                'route_name' => 'AdminApi.customers.index::',
                'key_authority' => 'customer_list',
                'menus' => json_encode(
                    [
                        'customer_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo Khách hàng',
                'group_name' => 'Khách hàng',
                'route_name' => 'AdminApi.customers.store::',
                'key_authority' => 'customer_create',
                'menus' => json_encode(
                    [
                        'customer_list',
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa Khách hàng',
                'group_name' => 'Khách hàng',
                'route_name' => 'AdminApi.customers.update::',
                'key_authority' => 'customer_update',
                'menus' => json_encode(
                    [
                        'customer_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá Khách hàng',
                'group_name' => 'Khách hàng',
                'route_name' => 'AdminApi.customers.destroy::',
                'key_authority' => 'customer_destroy',
                'menus' => json_encode(
                    [
                        'customer_list'
                    ]
                )
            ],
        ]);
    }

    private function insertAdminGroup(){
        $this->handleUpdate([

            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhóm nhân viên',
                'group_name' => 'Nhóm Nhân viên',
                'route_name' => 'AdminApi.admin-groups.index::',
                'key_authority' => 'admin_group_list',
                'menus' => json_encode(
                    [
                        'admin_group_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo nhóm nhân viên',
                'group_name' => 'Nhóm Nhân viên',
                'route_name' => 'AdminApi.admin-groups.store::',
                'key_authority' => 'admin_group_create',
                'menus' => json_encode(
                    [
                        'admin_group_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa Nhóm nhân viên',
                'group_name' => 'Nhóm Nhân viên',
                'route_name' => 'AdminApi.admin-groups.update::',
                'key_authority' => 'admin_group_update',
                'menus' => json_encode(
                    [
                        'admin_group_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá Nhóm nhân viên',
                'group_name' => 'Nhóm Nhân viên',
                'route_name' => 'AdminApi.admin-groups.destroy::',
                'key_authority' => 'admin_group_destroy',
                'menus' => json_encode(
                    [
                        'admin_group_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa quyền Nhóm nhân viên',
                'group_name' => 'Nhóm Nhân viên',
                'route_name' => 'AdminApi.admin-groups.permission::',
                'key_authority' => 'admin_group_permission',
                'menus' => json_encode(
                    [
                        'admin_group_list'
                    ]
                )
            ],
        ]);
    }

    private function insertAdmin(){
        $this->handleUpdate([
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhân viên',
                'group_name' => 'Nhân viên',
                'route_name' => 'AdminApi.admins.index::',
                'key_authority' => 'admin_list',
                'menus' => json_encode(
                    [
                        'admin_list'
                    ]
                )
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Tạo nhân viên',
                'group_name' => 'Nhân viên',
                'route_name' => 'AdminApi.admins.store::',
                'key_authority' => 'admin_create',
                'menus' => json_encode(
                    [
                        'admin_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Sửa nhân viên',
                'group_name' => 'Nhân viên',
                'route_name' => 'AdminApi.admins.update::',
                'key_authority' => 'admin_update',
                'menus' => json_encode(
                    [
                        'admin_list'
                    ]
                )
            ],[
                'id' => Str::uuid(),
                'name' => 'Xoá nhân viên',
                'group_name' => 'Nhân viên',
                'route_name' => 'AdminApi.admins.destroy::',
                'key_authority' => 'admin_destroy',
                'menus' => json_encode(
                    [
                        'admin_list'
                    ]
                )
            ],
        ]);
    }
}
