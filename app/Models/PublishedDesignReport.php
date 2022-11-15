<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishedDesignReport extends Model
{
    use HasFactory;

    //published design reports belong to customer
    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    
    //published design reports belong to published design
    public function publishedDesign(){
        return $this->belongsTo(PublishedDesign::class);
    }

    
}
