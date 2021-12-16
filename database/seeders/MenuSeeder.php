<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Repositories\Facades\MenuRepository;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data= $this->getData();
        foreach($data as $item){
            MenuRepository::updateOrCreate([
                'key_authority' => $item['key_authority']
            ],$item);
        }
    }
    public function getData(){
        return [
            [
                'id' => Str::uuid(),
                'name' => 'Dashboard',
                'key_authority' => 'dashboard',
                'parent_key_authority' => 'dashboard_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách kho Nanoco',
                'key_authority' => 'warehouse_list',
                'parent_key_authority' => 'branch_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách kho nhà cung cấp',
                'key_authority' => 'warehouse_provider_list',
                'parent_key_authority' => 'branch_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách đặt hàng',
                'key_authority' => 'order_list',
                'parent_key_authority' => 'order_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Đặt hàng',
                'key_authority' => 'order_form_create',
                'parent_key_authority' => 'order_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Sửa đặt hàng',
                'key_authority' => 'order_form_edit',
                'parent_key_authority' => 'order_manage',
            ],

            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhóm nhân viên',
                'key_authority' => 'admin_group_list',
                'parent_key_authority' => 'employee_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhân viên',
                'key_authority' => 'admin_list',
                'parent_key_authority' => 'employee_manage',
            ]
            ,
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách khách hàng',
                'key_authority' => 'customer_list',
                'parent_key_authority' => 'customer_manage',
            ],
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách nhà cung cấp',
                'key_authority' => 'provider_list',
                'parent_key_authority' => 'customer_manage',
            ]
            ,
            [
                'id' => Str::uuid(),
                'name' => 'Danh sách hàng hoá',
                'key_authority' => 'product_list',
                'parent_key_authority' => 'product_manage',
            ]
        ];
    }
}
