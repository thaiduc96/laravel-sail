<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Admin;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::insert([
            [
                'id' => Str::uuid(),
                'name' => "Super admin",
                'code' => '1',
                'email' => 'thducit@gmail.com',
                'phone' => '0978533952',
                'password' => Hash::make('123456'),
                'admin_group_id' => '5767ff8d-12c6-4196-92c2-0224c434ad25',
            ], [
                'id' => Str::uuid(),
                'name' => "Admin 2",
                'code' => '2',
                'email' => 'admin@admin.com',
                'phone' => '0966624896',
                'password' => Hash::make('123456'),
                'admin_group_id' => '5767ff8d-12c6-4196-92c2-0224c434ad25',
            ], [
                'id' => Str::uuid(),
                'name' => "Admin 1",
                'code' => '3',
                'email' => 'admin1@admin.com',
                'phone' => '0978533953',
                'password' => Hash::make('123456'),
                'admin_group_id' => 'abb1dbf4-710f-44da-972a-19955e8615f6',
            ], [
                'id' => Str::uuid(),
                'code' => '4',
                'name' => "Nhân viên",
                'email' => 'employee@admin.com',
                'phone' => '0978533956',
                'password' => Hash::make('123456'),
                'admin_group_id' => '426d2c3a-498a-416c-b899-ce1cca84b450',
            ],
        ]);
    }
}
