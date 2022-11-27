<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    //one type has many plainTeeTypeColor
    public function plainTeeTypeColors(){
        return $this->hasMany(PlainTeeTypeColor::class);
    }

}
