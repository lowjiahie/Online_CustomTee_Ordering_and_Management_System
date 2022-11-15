<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintingMethod extends Model
{
    use HasFactory;

    //One Printing Method has many OrderedCustomTees
    public function orderCustomTees(){
        return $this->hasMany(OrderedCustomTee::class);
    }
}
