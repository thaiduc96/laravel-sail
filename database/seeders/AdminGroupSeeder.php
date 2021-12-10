<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class AdminGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\AdminGroup::insert([
            [
                'id' => '5767ff8d-12c6-4196-92c2-0224c434ad25',
                'name' => "Super admin",
                'key' => 'super_admin',
                'description' => 'ADMIN',
            ],
            [
                'id' => 'abb1dbf4-710f-44da-972a-19955e8615f6',
                'name' => "Admin",
                'key' => 'admin',
                'description' => 'Quản trị',
            ],
            [
                'id' => '426d2c3a-498a-416c-b899-ce1cca84b450',
                'name' => "Sales",
                'key' => 'sales',
                'description' => 'Nhân viên mua hàng',
            ],
            [
                'id' => '426d2c3a-498a-416c-b899-ce1cca84b451',
                'name' => "Chuỗi cung ứng",
                'key' => 'supply_chain',
                'description' => 'Nhân viên chuỗi cung ứng',
            ],
            [
                'id' => '426d2c3a-498a-416c-b899-ce1cca84b452',
                'name' => "Nhà cung cấp",
                'key' => 'provider',
                'description' => 'Nhà cung cấp',
            ],
        ]);
    }
}
