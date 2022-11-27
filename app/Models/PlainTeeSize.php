<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlainTeeSize extends Model
{
    use HasFactory;

    //One PlainTeeSize has many OrderedCustomTees
    public function orderedCustomTees(){
        return $this->hasMany(OrderedCustomTee::class);
    }

    //Many PlainTeeSize belong to one plainTeeTypeColors
    public function plainTeeTypeColor(){
        return $this->belongsTo(PlainTeeTypeColor::class);
    }
}
