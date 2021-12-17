<?php

namespace App\Imports;

use App\Exceptions\ErrorCode;
use App\Repositories\Facades\InventoryRepository;
use App\Repositories\Facades\ProductRepository;
use App\Repositories\Facades\ProviderRepository;
use App\Repositories\Facades\WarehouseProviderRepository;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithBatchInserts;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class InventoryImport implements ToCollection, WithBatchInserts, WithHeadingRow
{
    use Importable;

    private $rowErrors = [];
    private $errors = [];
    private $countSuccess = 0;

    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        $arrCollection = $collection->toArray();

        $providers = $this->getProvider($arrCollection);
        $products = $this->getProducts($arrCollection);
        $warehouses = $this->getWarehouse($arrCollection);

        $this->errors = [];
        $rowValid = [];
        foreach ($collection as $lineNumber => $row) {
            foreach($row as $key => $value){
                $row[$key] = trim($value);
            }
            if(empty($row['ma_hang'])){
                continue;
            }
            $error = [];
            if (empty($products[trim($row['ma_hang'])])) {
                $error[ErrorCode::PRODUCT_NOT_FOUND] = trans('validation.data_not_exists', ['field' => trans('validation.attributes.product'), 'attribute' => $row['ma_hang']]);
            }
            if (empty($providers[trim($row['ma_nha_cung_cap'])])) {
                $error[ErrorCode::PROVIDER_NOT_FOUND] = trans('validation.data_not_exists', ['field' => trans('validation.attributes.provider'), 'attribute' => $row['ma_nha_cung_cap']]);
            }
            if (empty($warehouses[trim($row['kho'])])) {
                $error[ErrorCode::WAREHOUSE_NOT_FOUND] = trans('validation.data_not_exists', ['field' => trans('validation.attributes.warehouse'), 'attribute' => $row['kho']]);
            }

            if (empty($error)) {
                $rowValid [] = [
                    'product_id' =>  $products[trim($row['ma_hang'])]['id'],
                    'warehouse_provider_id' =>  $products[trim($row['kho'])]['id'],
                    'provider_id' =>  $providers[trim($row['ma_nha_cung_cap'])]['id'],
                    'quantity' => trim($row['ton']),
                ];
            } else {
                unset($row['']);
                $this->errors [] = [
                    'data' => (object)$row,
                    'lineNumber' => $lineNumber + 1,
                    'errorCode' => implode(',', array_keys($error)),
                    'errorMessage' => implode(',', array_values($error)),
                ];
                $this->rowErrors [] = $row;
            }
        }

        if (!empty($rowValid)) {
            foreach($rowValid as $row){
                InventoryRepository::create($row);
            }
            $this->countSuccess = count($rowValid);
            Cache::flush();
        }
    }

    private function getWarehouse($arrCollection)
    {
        $names = array_filter(array_unique(array_column($arrCollection, 'kho')));
        $types = WarehouseProviderRepository::filter([
            'name' => $names
        ]);
        $types = collect($types)->keyBy(function ($a) {
            return $a['name'];
        })->toArray();
        return $types;
    }


    private function getProvider($arrCollection)
    {
        $names = array_filter(array_unique(array_column($arrCollection, 'ma_nha_cung_cap')));
        $types = ProviderRepository::filter([
            'names' => $names
        ]);
        $types = collect($types)->keyBy(function ($a) {
            return $a['name'];
        })->toArray();
        return $types;
    }

    private function getProducts($arrCollection)
    {
        $ids = array_filter(array_unique(array_column($arrCollection, 'ma_hang')));
        $types = ProductRepository::filter([
            'in_sap' => $ids
        ]);
        $types = collect($types)->keyBy(function ($a) {
            return $a['sap_id'];
        })->toArray();
        return $types;
    }


    public function toResponse($arr): array
    {
        return array_merge([
            'line_errors' => $this->getErrors(),
            'total_imported' => $this->getCountSuccess(),
            'total_errors' => count($this->getErrors()),
        ], $arr);
    }

    public function getCountSuccess(): int
    {
        return $this->countSuccess;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }

    public function getRowErrors(): array
    {
        return $this->rowErrors;
    }

    public function batchSize(): int
    {
        return 1000;
    }
}
