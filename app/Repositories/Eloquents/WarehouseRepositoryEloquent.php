<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Warehouse;
use App\Repositories\Contracts\WarehouseContract;
use Illuminate\Database\Eloquent\Model;

 
class WarehouseRepositoryEloquent extends BaseRepositoryEloquent implements WarehouseContract 
{
public function getModel(): Model 
 { 
return new Warehouse; 
 } 
}
