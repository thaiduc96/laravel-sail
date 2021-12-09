<?php

namespace App\Models;

use App\Traits\Filterable;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminGroupPermission extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'admin_permission_id',
        'admin_group_id',
    ];

}
