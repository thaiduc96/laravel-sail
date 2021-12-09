<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class AdminGroup extends Base
{
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'key',
        'name',
        'status',
        'description',
        'percent_discount',
    ];

    protected $filterable = [
        'key',
        'status',
    ];

    protected $filterLike = [
        'name',
        'description',
    ];

    public function filterSearch($query, $value)
    {
        if (empty($value)) return $query;
        return $query->where(function ($q) use ($value){
            $q->where('name', 'ILIKE', "%" . $value . "%")
            ;
        });
    }

    public function filterNotSuperAdmin($query, $value)
    {
        return $query->where($this->getTable() . '.key', '<>', SUPER_ADMIN);
    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->key)) {
                $model->key = Str::snake($model->name);
            }
        });
        static::updating(function ($model) {
            $model->key = Str::snake($model->name);
        });
    }

    public function admins(): HasMany
    {
        return $this->hasMany(Admin::class, 'admin_group_id', 'id');
    }

    public function adminPermissions(): BelongsToMany
    {
        return $this->belongsToMany(AdminPermission::class, 'admin_group_permissions', 'admin_group_id', 'admin_permission_id')
            ->using(new class extends Pivot {
                use UuidTrait;
            });
    }

}
