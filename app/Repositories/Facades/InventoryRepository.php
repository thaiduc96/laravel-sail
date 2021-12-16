<?php 
namespace App\Repositories\Facades;
 
use Illuminate\Support\Facades\Facade; 

class InventoryRepository extends Facade 
 { 
    protected static function getFacadeAccessor(){ return self::class; }  
 } 
