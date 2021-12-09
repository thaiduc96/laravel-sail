<?php

namespace App\Models;

use App\Traits\Filterable;
use App\Traits\StatusTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Admin extends Authenticatable implements JWTSubject
{
    use Notifiable;
    use Filterable;
    use SoftDeletes;
    use StatusTrait;

    protected $primaryKey = 'id';
    protected $keyType = 'string';
    public $incrementing = false;

    public $defaultOrderBy = 'created_at';
    public $defaultOrderDirection = 'desc';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'phone', 'address', 'admin_group_id', 'status', 'code', 'province_id', 'district_id', 'ward_id', 'branch_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }


    protected $filterable = [
        'admin_group_id',
        'status',
        'branch_id',
    ];

    protected $filterLike = [
        'name',
        'email',
        'phone',
        'address',
        'code',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if ('string' === $model->keyType && !$model->id) {
                $model->id = (string)Str::uuid();
            }

            if (empty($model->password)) {
                $model->password = Hash::make($model->email);
            } else {
                $model->password = Hash::make($model->password);
            }
        });

    }

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public function adminGroup(): BelongsTo
    {
        return $this->belongsTo(AdminGroup::class, 'admin_group_id', 'id');
    }

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class, 'warehouse_id', 'id');
    }


    public function hasPermission(AdminPermission $permission): bool
    {
        //contains dung để kiểm tra xem nó có chứa permission k
        // ep kiểu boolean
        return !!optional(optional($this->adminGroup)->adminPermissions)->contains($permission);
    }
}
