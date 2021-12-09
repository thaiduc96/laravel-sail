<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'name',
        'key_authority',
        'parent_key_authority',
    ];

    protected $filterable =[
        'parent_key_authority'
    ];

    protected $filterLike = [
        'name',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(AdminPermission::class, 'menu_permissions', 'menu_id', 'admin_permission_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }
}
