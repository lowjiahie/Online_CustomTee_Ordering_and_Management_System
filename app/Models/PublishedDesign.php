<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedDesign extends Model
{
    use HasFactory;

    //published designs belong to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //publishedDesign one to many polymorphic orderItems
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderItemable');
    }

    //publishedDesign has many PublishedDesignReports
    public function publishedDesignReports()
    {
        return $this->hasMany(PublishedDesignReport::class);
    }
    
    //publishedDesign belongToMany customers (pivot -SavedPurchasedDesigns)
    public function savedPurchasedDesigns()
    {
        return $this->belongsToMany(Customer::class,'saved_purchased_designs');
    }

}
