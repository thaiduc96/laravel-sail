<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ward;
class WardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $list = json_decode(file_get_contents(
            public_path('global/xa_phuong.json')
        ), true);
        foreach($list as $item){
            $data = [
                'id' => $item['code'],
                'name' => $item['name'],
                'slug' => $item['slug'],
                'type' => $item['type'],
                'name_with_type' => $item['name_with_type'],
                'path' => $item['path'],
                'path_with_type' => $item['path_with_type'],
                'district_id' => $item['parent_code'],
            ];
            $exists = Ward::find($item['code']);
            if($exists){
                $exists->update($data);
            }else{
                Ward::create($data);
            }
        }
    }
}
