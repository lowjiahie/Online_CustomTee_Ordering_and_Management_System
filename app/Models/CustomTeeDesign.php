<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CustomTeeDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'front_design_img', 'back_design_img',
        'front_design_json', 'back_design_json', 'pt_type_color_id', 'cus_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'c_tee_design_id';

    //Many CustomTeeDesign belong to one PlainTeeTypeColors
    public function plainTeeTypeColor()
    {
        return $this->belongsTo(PlainTeeTypeColor::class);
    }


    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->c_tee_design_id = IdGenerator::generate(['table' => 'custom_tee_designs', 'field' => 'c_tee_design_id', 'length' => 7, 'prefix' => 'CD']);
        });
    }
}
