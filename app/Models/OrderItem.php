<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    //orderitems polymorphic orderItemable model (PublishedDeisgns or OrderedCustomTees)
    public function orderItemable(){
        return $this->morphTo();
    }

    //orderItems belong to order
    public function order(){
        return $this->belongsTo(Order::class);
    }


}
