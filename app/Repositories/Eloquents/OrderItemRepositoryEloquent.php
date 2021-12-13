<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\OrderItem;
use App\Repositories\Contracts\OrderItemContract;
use Illuminate\Database\Eloquent\Model;

 
class OrderItemRepositoryEloquent extends BaseRepositoryEloquent implements OrderItemContract 
{
public function getModel(): Model 
 { 
return new OrderItem; 
 } 
}
