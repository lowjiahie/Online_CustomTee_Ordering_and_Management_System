<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_item_id', 'total_qty', 'status', 'orderItemable_id', 'orderItemable_type',
        'order_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'order_item_id';

    //orderitems polymorphic orderItemable model (PublishedDeisgns or OrderedCustomTees)
    public function orderItemable()
    {
        return $this->morphTo();
    }

    //orderItems belong to order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'order_item_id', 'length' => 7, 'prefix' => 'OI']);
        });
    }
}
