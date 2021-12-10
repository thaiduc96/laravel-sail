<?php 

namespace App\Repositories\Eloquents;
 
use App\Models\MenuPermission;
use App\Repositories\Contracts\MenuPermissionContract;
use Illuminate\Database\Eloquent\Model;

 
class MenuPermissionRepositoryEloquent extends BaseRepositoryEloquent implements MenuPermissionContract 
{
public function getModel(): Model 
 { 
return new MenuPermission; 
 } 
}
