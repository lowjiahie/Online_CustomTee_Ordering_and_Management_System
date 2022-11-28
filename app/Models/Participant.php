<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Participant extends Model
{
    use HasFactory, HasCompositeKey;

    protected $fillable = [
        'competition_id', 'cus_id', 'status', 'front_design_img', 'back_design_img', 
        'front_design_json', 'back_design_json'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = ['competition_id', 'cus_id'];
}
