<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\District;
use App\Repositories\Contracts\DistrictContract;
use Illuminate\Database\Eloquent\Model;

 
class DistrictRepositoryEloquent extends BaseRepositoryEloquent implements DistrictContract 
{
public function getModel(): Model 
 { 
return new District; 
 } 
}
