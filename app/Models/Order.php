<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    //one order has one delivery details 
    public function deliveryDetails(){
        $this->hasOne(DeliveryDetail::class);
    }

    //one order has many order items
    public function orderItems(){
        $this->hasMany(OrderItem::class);
    }

    //Many orders belongTo customer
    public function customer(){
        $this->belongsTo(Customer::class);
    }


}
