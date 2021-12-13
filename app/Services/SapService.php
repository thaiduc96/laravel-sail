<?php
namespace App\Services;

use App\Repositories\Facades\CustomerRepository;
use App\Repositories\Facades\ProductRepository;
use App\Repositories\Facades\ProviderRepository;
use App\Repositories\Facades\ProvinceRepository;
use App\Repositories\Facades\WarehouseRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class SapService
{
    const TABLE_WAREHOUSE = 'warehouse_saps';
    const TABLE_PRODUCT = 'product_saps';
    const TABLE_CUSTOMER = 'customer_saps';
    const TABLE_PROVIDER = 'provider_saps';

    public function cleanProvinceName($name,$isSnake = true){
        $name = str_replace('Tỉnh','',$name);
        $name = str_replace('Thành phố','',$name);
        $name = trim($name);

        $name = $this->handleSpecialCaseProvince($name);
        return $isSnake ? Str::of($name)->ascii()->snake('-') :Str::of($name)->trim();
    }
    public function cleanDistrictName($name,$isSnake = true){
        $name = str_replace('Huyện','',$name);
        $name = str_replace('Thành phố','',$name);
        $name = str_replace('Thành Phố','',$name);
        $name = str_replace('Thành phó','',$name);
        $name = str_replace('Thị xã','',$name);
        $name = str_replace('Thị Xã','',$name);
        $name = str_replace('Quận','',$name);
        $name = str_replace("’",'-',$name);
        $name = str_replace("'",'-',$name);
        $name = trim($name);
        $name = $this->handleSpecialCase($name);
        return $isSnake ? Str::of($name)->ascii()->lower()->snake('-')->replace('--','-'):Str::of($name)->trim();
    }

    public function handleSpecialCaseProvince($name){
        switch ($name){
            case 'Huế':
                return 'Thừa Thiên Huế';
            case 'Đắc Lắc':
            case 'Ðắc Lắc':
                return 'Đắk Lắk';
        }
        return $name;
    }
    public function handleSpecialCase($name){
        switch ($name){
            case 'ss':
                return '26';
            case 'Đắc Lắc':
            case 'Ðắc Lắc':
                return 'Đắk Lắk';
            case 'Thường Tính':
                return 'Thường Tín';
            case 'Vũ Quý':
                return 'Vũ Quí';
        }
        return $name;
    }

    public function cleanWardName($name,$isSnake = true){
        $name = str_replace('Xã','',$name);
        $name = str_replace('Phường','',$name);
        $name = str_replace('Thị trấn','',$name);
        $name = str_replace('Thị Trấn','',$name);
        $name = str_replace("’",'-',$name);
        $name = str_replace("'",'-',$name);
        $name = trim($name);

        $name = $this->handleSpecialCase($name);
        return $isSnake ? Str::of($name)->ascii()->lower()->snake('-') :Str::of($name)->trim();
    }

    /*
        * tạo mới nếu chưa tồn tại
        * sau đó kiểm tra nếu có kho nào tồn lại trong local nhưng k có ở sap thì update inactive
        */
    public function handleCustomer()
    {
        DB::beginTransaction();
        try {
            $data = DB::table(self::TABLE_CUSTOMER)->get();
            $arrSAPId = [];

            foreach ($data as $key => $item) {
                $arrSAPId [] = $item->id;
                $localItem = CustomerRepository::findByCondition([
                    'sap_id' => $item->id,
                ]);

                $phone = explode(',', $item->phone);
                foreach($phone as &$p){
                    $p = preg_replace('/[^0-9]/', '', $p);
                }
                $province = ProvinceRepository::findByCondition([
                    'name_with_type' => $item->province
                ]);
                if (empty($localItem)) {

                    $localItem = CustomerRepository::create([
                        'sap_id' => $item->id,
                        'province_id' => $province ? $province->id : null,
                        'name' => $item->name,
                        'email' => str_replace(',', ', ', $item->email),
                        'address' => $item->address,
                        'phones' => $phone,
                        'sale_org' => $item->sale_org,
                        'company' => $item->company,
                        'status' => STATUS_ACTIVE
                    ]);
                } elseif ($localItem->status == STATUS_INACTIVE) {
                    $localItem->status = STATUS_ACTIVE;
                    $localItem->save();
                }else{
                    $localItem = CustomerRepository::update($localItem,[
                        'province_id' => $province ? $province->id : null,
                        'name' => $item->name,
                        'email' => str_replace(',', ', ', $item->email),
                        'address' => $item->address,
                        'phones' => $phone,
                        'sale_org' => $item->sale_org,
                        'company' => $item->company,
                        'status' => STATUS_ACTIVE
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /*
        * tạo mới nếu chưa tồn tại
        * sau đó kiểm tra nếu có kho nào tồn lại trong local nhưng k có ở sap thì update inactive
        */
    public function handleProduct()
    {
        DB::beginTransaction();
        try {

            $data = DB::table(self::TABLE_PRODUCT)->get();
            $arrSAPId = [];

            foreach ($data as $key => $item) {
                $arrSAPId [] = $item->id;
                $localItem = ProductRepository::findByCondition([
                    'sap_id' => $item->id,
                ]);
                if (empty($localItem)) {
                    ProductRepository::create([
                        'sap_id' => $item->id,
                        'code' => $item->id,
                        'name' => $item->name,
                        'status' => STATUS_ACTIVE,
                        'origin' => $item->origin
                    ]);
                } else {
                    ProductRepository::update($localItem,[
                        'code' => $item->id,
                        'name' => $item->name,
                        'status' => STATUS_ACTIVE,
                        'origin' => $item->origin
                    ]);
                }
            }
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
//        ProductRepository::updateByCondition([
//            'not_in_sap' => $arrSAPId
//        ], [
//            'status' => STATUS_INACTIVE
//        ]);
    }


    /*
     * tạo mới nếu chưa tồn tại
     * sau đó kiểm tra nếu có kho nào tồn lại trong local nhưng k có ở sap thì update inactive
     */
    public function handleWarehouse()
    {

        DB::beginTransaction();
        try {
            $warehouses = DB::table(self::TABLE_WAREHOUSE)->get();

            $arrCode = [];
            foreach ($warehouses as $warehouseSAP) {
                if (substr(trim($warehouseSAP->id), '0', '1') !== 'V') {
                    $arrCode [] = $warehouseSAP->id;
                    $localWarehouse = WarehouseRepository::findByCondition([
                        'code' => $warehouseSAP->id
                    ]);
                    if (empty($localWarehouse)) {
                        WarehouseRepository::create([
                            'code' => $warehouseSAP->id,
                            'name' => $warehouseSAP->name,
                            'status' => STATUS_ACTIVE
                        ]);
                    } else {
                        WarehouseRepository::update($localWarehouse,[
                            'code' => $warehouseSAP->id,
                            'name' => $warehouseSAP->name,
                            'status' => STATUS_ACTIVE
                        ]);
                    }
                }
            }

            WarehouseRepository::updateByCondition([
                'not_in_codes' => $arrCode
            ], [
                'status' => STATUS_INACTIVE
            ]);
            WarehouseRepository::updateByCondition([
                'in_codes' => $arrCode
            ], [
                'status' => STATUS_ACTIVE
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }

    /*
     * tạo mới nếu chưa tồn tại
     * sau đó kiểm tra nếu có kho nào tồn lại trong local nhưng k có ở sap thì update inactive
     */
    public function handleProvider()
    {
        DB::beginTransaction();
        try {
            $data = DB::table(self::TABLE_PROVIDER)->get();
            $arrSAPId = [];

            foreach ($data as $key => $item) {
                $arrSAPId [] = $item->id;
                $localItem = ProviderRepository::findByCondition([
                    'sap_id' => $item->id,
                ]);
                $province = ProvinceRepository::findByCondition([
                    'slug' => $this->cleanProvinceName($item->province_name)
                ]);

                if (empty($localItem)) {
                    ProviderRepository::create([
                        'sap_id' => $item->id,
                        'name' => $item->name,
                        'status' => STATUS_ACTIVE,
                        'sap_phone' => $item->phone,
                        'province_id' => $province->id ?? null
                    ]);
                } else {
                    ProviderRepository::update($localItem,[
                        'name' => $item->name,
                        'status' => STATUS_ACTIVE,
                        'sap_phone' => $item->phone,
                        'province_id' => $province->id ?? null
                    ]);
                }
            }
            ProviderRepository::updateByCondition([
                'not_in_sap' => $arrSAPId
            ], [
                'status' => STATUS_INACTIVE
            ]);
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollBack();
            throw $ex;
        }
    }
}
