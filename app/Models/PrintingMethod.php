<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_method_id','name','price','minimum_order', 'status'
    ];

    //One Printing Method has many OrderedCustomTees
    public function orderCustomTees(){
        return $this->hasMany(OrderedCustomTee::class);
    }
}
