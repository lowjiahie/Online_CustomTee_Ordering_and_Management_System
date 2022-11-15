<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DeliveryDetail extends Model
{
    use HasFactory;

    //one deliveryDetail belongTo one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
