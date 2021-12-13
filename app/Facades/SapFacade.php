<?php
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class SapFacade extends Facade
{
    protected static function getFacadeAccessor(){ return self::class; }
}
