<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProvinceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $provinces = json_decode(file_get_contents(
            public_path('global/tinh_tp.json')
        ), true);
        foreach($provinces as $item){
            \App\Models\Province::create([
                'id' => $item['code'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'type' => $item['type'],
                'name_with_type' => $item['name_with_type'],
                'region' => $item['region'],
            ]);
        }
    }
}
