<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Order;
use App\Repositories\Contracts\OrderContract;
use Illuminate\Database\Eloquent\Model;

 
class OrderRepositoryEloquent extends BaseRepositoryEloquent implements OrderContract 
{
public function getModel(): Model 
 { 
return new Order; 
 } 
}
