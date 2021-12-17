<?php
namespace App\Services;

use App\Exports\Export\ExportInventory;
use App\Helpers\UploadHelper;
use App\Imports\InventoryImport;
use App\Repositories\Facades\InventoryRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InventoryService
{
    public function filter($filter)
    {
        $list = InventoryRepository::filter($filter);
        return $list;
    }

    public function create($data)
    {
        $file = request()->file('file');
        $fileExportName = config('upload_path.fail_path') . UploadHelper::generateFileName($file->getClientOriginalName());
        $import = new InventoryImport();
        $import->import($file);

        if (!empty($import->getRowErrors())) {
            Excel::store(new ExportInventory($import->getRowErrors()), $fileExportName, 's3', null, [
                'visibility' => 'public',
            ]);
        }
        return $import->toResponse([
            'error_file' => !empty($import->getRowErrors()) ? Storage::url($fileExportName) : null
        ]);
    }

    public function find($id)
    {
        $res = InventoryRepository::findOrFail($id);
        return $res;
    }

    public function update($id, $data)
    {
        $model = InventoryRepository::findOrFail($id);
        $res = InventoryRepository::update($model, $data);
        return $res;
    }

    public function delete($model)
    {
        $model = $model instanceof Model ? $model : InventoryRepository::find($model);
        return InventoryRepository::delete($model);
    }

    public function recovery($model)
    {
        return InventoryRepository::recovery($model);
    }
}
