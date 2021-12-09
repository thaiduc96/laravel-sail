<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class MenuPermission extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'menu_id',
        'admin_permission_id',
    ];

}
