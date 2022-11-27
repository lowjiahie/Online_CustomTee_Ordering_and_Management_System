<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Staff extends Model
{
    use HasFactory;

    //One staff can create many competitions
    public function competitions(){
        return $this->hasMany(Staff::class);
    }
    
}
