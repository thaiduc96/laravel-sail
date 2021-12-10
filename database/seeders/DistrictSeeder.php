<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\District;

class DistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = json_decode(file_get_contents(
            public_path('global/quan_huyen.json')
        ), true);
        foreach($list as $item){
            $data  = [
                'id' => $item['code'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'type' => $item['type'],
                'name_with_type' => $item['name_with_type'],
                'path' => $item['path'],
                'path_with_type' => $item['path_with_type'],
                'province_id' => $item['parent_code'],
            ];
            $exists = District::find($item['code']);
            if($exists){
                $exists->update($data);
            }else{
                District::create($data);
            }
        }
    }
}
