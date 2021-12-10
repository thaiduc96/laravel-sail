<?php 
namespace App\Facades;
use Illuminate\Support\Facades\Facade;
class UserForgotPasswordFacade extends Facade
{
    protected static function getFacadeAccessor(){ return self::class; } 
} 