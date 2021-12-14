<?php

namespace App\Models;

use App\Repositories\Facades\ProductRepository;
use App\Traits\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderItem extends Base
{
    use HasFactory;
    use SoftDeletes;
    use Filterable;

    protected $fillable = [
        'order_id',
        'product_id',
        'product_code',
        'product_name',
        'quantity',
        'provider_note',
        'provider_confirm',
        'supply_chain_note',
        'expected_delivery_time',
    ];

    protected $filterable = [
        'order_id',
        'product_id',
    ];

    protected $filterLike = [
        'product_code',
        'product_name',
        'quantity',
        'provider_note',
        'supply_chain_note',
    ];

    public static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if(empty($model->product_code)){
                $product = ProductRepository::find($model->product_id);
                $model->product_code = $product->code;
                $model->product_name = $product->name;
            }
        });
        static::updating(function ($model) {
            if($model->product_id != $model->getOriginal('product_id')){
                $product = ProductRepository::find($model->product_id);
                $model->product_code = $product->code;
                $model->product_name = $product->name;
            }
        });
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
