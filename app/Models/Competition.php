<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competition extends Model
{
    use HasFactory;

    //One competition belongToMany customers (pivot - participants)
    public function participants()
    {
        return $this->belongsToMany(Customer::class, 'participants');
    }

    //Competitions belong to one staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }
}
