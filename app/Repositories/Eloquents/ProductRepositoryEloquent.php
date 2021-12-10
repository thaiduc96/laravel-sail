<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Product;
use App\Repositories\Contracts\ProductContract;
use Illuminate\Database\Eloquent\Model;

 
class ProductRepositoryEloquent extends BaseRepositoryEloquent implements ProductContract 
{
public function getModel(): Model 
 { 
return new Product; 
 } 
}
