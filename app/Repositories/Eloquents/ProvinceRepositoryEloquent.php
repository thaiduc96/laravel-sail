<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Province;
use App\Repositories\Contracts\ProvinceContract;
use Illuminate\Database\Eloquent\Model;

 
class ProvinceRepositoryEloquent extends BaseRepositoryEloquent implements ProvinceContract 
{
public function getModel(): Model 
 { 
return new Province; 
 } 
}
