<?php 
namespace App\Repositories\Facades;
 
use Illuminate\Support\Facades\Facade; 

class MenuRepository extends Facade 
 { 
    protected static function getFacadeAccessor(){ return self::class; }  
 } 
