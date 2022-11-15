<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaypalAccount extends Model
{
    use HasFactory;

    //paypalAccount belong to customer 
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
