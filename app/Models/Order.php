<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id', 'shipping_address', 'order_date', 'payment_method', 'status',
        'totalPrice', 'payment_rf_num', 'delivery_detail_id', 'cus_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'order_id';

    //one order has one delivery details 
    public function deliveryDetails()
    {
        $this->hasOne(DeliveryDetail::class);
    }

    //one order has many order items
    public function orderItems()
    {
        $this->hasMany(OrderItem::class);
    }

    //Many orders belongTo customer
    public function customer()
    {
        $this->belongsTo(Customer::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'order_id', 'length' => 7, 'prefix' => 'OR']);
        });
    }
}
