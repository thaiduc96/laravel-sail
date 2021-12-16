<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Inventory;
use App\Repositories\Contracts\InventoryContract;
use Illuminate\Database\Eloquent\Model;

 
class InventoryRepositoryEloquent extends BaseRepositoryEloquent implements InventoryContract 
{
public function getModel(): Model 
 { 
return new Inventory; 
 } 
}
