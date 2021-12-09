<?php

use Illuminate\Support\Facades\Auth;

function canPermission($route, $param = null)
{


    if (!Auth::user()->can($route)) {
        return null;
    }
    return route($route, $param);
}

