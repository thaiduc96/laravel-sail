<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\Provider;
use App\Repositories\Contracts\ProviderContract;
use Illuminate\Database\Eloquent\Model;

 
class ProviderRepositoryEloquent extends BaseRepositoryEloquent implements ProviderContract 
{
public function getModel(): Model 
 { 
return new Provider; 
 } 
}
