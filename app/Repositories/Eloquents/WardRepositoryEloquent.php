<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Ward;
use App\Repositories\Contracts\WardContract;
use Illuminate\Database\Eloquent\Model;

 
class WardRepositoryEloquent extends BaseRepositoryEloquent implements WardContract 
{
public function getModel(): Model 
 { 
return new Ward; 
 } 
}
