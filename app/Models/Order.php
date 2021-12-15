<?php

namespace App\Models;

use App\Repositories\Facades\CustomerRepository;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Order extends Base
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    CONST STATUS_WAITING_PROVIDER_CONFIRM = 'p_conf';
    CONST STATUS_WAITING_SUPPLY_CHAIN_CONFIRM = 'sc_conf';
    CONST STATUS_WAITING_SALE_CONFIRM = 's_conf';
    CONST STATUS_WAITING_SUPPLY_CHAIN_ORDER = 'sc_od';
    CONST STATUS_ORDER = 'ordered';

    protected $fillable = [
        'provider_id',
        'customer_id',
        'customer_name',
        'warehouse_id',
        'created_by',
        'status',
    ];

    protected $filterable = [
        'customer_id',
        'provider_id',
        'created_by',
        'customer_address_id',
    ];

    protected $filterLike = [
        'customer_name',
        'customer_phone',
        'customer_address',
        'tech_note',
        'detail',
        'distance',
    ];

    public static function getTableName()
    {
        return (new self())->getTable();
    }

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->customer_name)) {
                $customer = CustomerRepository::find($model->customer_id);
                $model->customer_name = $customer->name;
            }
            if (empty($model->status)) {
                $model->status = self::STATUS_WAITING_PROVIDER_CONFIRM;
            }
        });
        static::updating(function ($model) {
            if ($model->customer_id != $model->getOriginal('customer_id')) {
                $customer = CustomerRepository::find($model->customer_id);
                $model->customer_name = $customer->name;
            }
            switch ($model->getOriginal('status')){
                case self::STATUS_WAITING_PROVIDER_CONFIRM:
                    $model->status = self::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM;
                    break;
                case self::STATUS_WAITING_SUPPLY_CHAIN_CONFIRM:
                    $model->status = self::STATUS_WAITING_SALE_CONFIRM;
                    break;
                case self::STATUS_WAITING_SALE_CONFIRM:
                    $model->status = self::STATUS_WAITING_SUPPLY_CHAIN_ORDER;
                    break;
                case self::STATUS_WAITING_SUPPLY_CHAIN_ORDER:
                    $model->status = self::STATUS_ORDER;
            }
        });
    }

    public function provider(): BelongsTo
    {
        return $this->belongsTo(Provider::class, 'provider_id', 'id');
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class, 'customer_id', 'id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'id');
    }
}
