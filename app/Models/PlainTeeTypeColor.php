<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlainTeeTypeColor extends Model
{
    use HasFactory;

    //One plainTeeTypeColor has many plainTeeSizes
    public function plainTeeSizes(){
        return $this->hasMany(PlainTeeSize::class);
    }

    //One plainTeeTypeColor belongToMany customers
    public function customers(){
        return $this->belongsToMany(Customer::class,'custom_tee_designs');
    }

    //Many plainTeeTypeColors belong to one type
    public function type(){
        return $this->belongsTo(Type::class);
    }

    //Many plainTeeTypeColors belong to one color
    public function color(){
        return $this->belongsTo(Color::class);
    }
}
