<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdminPermission extends Base
{
    use SoftDeletes;
    use Filterable;

    public $defaultOrderBy = 'group_name';
    public $defaultOrderDirection = 'asc';

    protected $fillable = [
        'name',
        'group_name',
        'route_name',
        'key_authority',
        'menus',
    ];

    protected $filterable = [
        'key_authority'
    ];

    protected $filterLike = [
        'name',
        'group_name',
        'route_name',
    ];

    protected $casts = [
        'menus' => 'array'
    ];

    public function filterAdminGroupId($query, $value){
        if (empty($value)) return $query;
        return $query->whereHas('adminGroups', function($q) use ($value){
            $q->where('admin_groups.id', '=', $value);
        });
    }

    public function adminGroups(): BelongsToMany
    {
        return $this->belongsToMany(AdminGroup::class, 'admin_group_permissions', 'admin_permission_id', 'admin_group_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }

    public function menus(): BelongsToMany
    {
        return $this->belongsToMany(Menu::class, 'menu_permissions', 'admin_permission_id', 'menu_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }
}
