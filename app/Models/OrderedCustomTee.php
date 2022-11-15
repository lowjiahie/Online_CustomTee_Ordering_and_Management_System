<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderedCustomTee extends Model
{
    use HasFactory;

    //OrderedCustomTee one to many polymorphic orderItems
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderItemable');
    }

    //OrderedCustomTees belong to one printingMethods
    public function printingMethod(){
        return $this->belongsTo(PrintingMethod::class);
    }

    //OrderedCustomTees belong to one orderedDesigns
    public function orderDesign(){
        return $this->belongsTo(OrderDesign::class);
    }

    //OrderedCustomTees belong to one plainTeeSizes
    public function plainTeeSize(){
        return $this->belongsTo(PlainTeeSize::class);
    }

    //OrderedCustomTees belong to one customers
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
}
