<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;

class CustomTeeDesign extends Model
{
    use HasFactory, HasCompositeKey;

    protected $fillable = [
        'pt_type_color_id', 'cus_id', 'name', 'front_design_img', 'back_design_img', 
        'front_design_json', 'back_design_json'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = ['pt_type_color_id', 'cus_id'];
}
