<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;

    //One Color has many plainTeeTypeColors
    public function plainTeeTypeColors()
    {
        return $this->hasMany(PlainTeeTypeColors::class);
    }
}
