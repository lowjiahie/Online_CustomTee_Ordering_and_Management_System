<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderedDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'o_design_id', 'name', 'front_design_img', 'back_design_img', 'front_design_json',
        'back_design_json'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'o_design_id';

    //One OrderDesign has many orderedCustomTees
    public function orderedCustomTees()
    {
        return $this->hasMany(OrderedCustomTee::class);
    }
    

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'o_design_id', 'length' => 7, 'prefix' => 'OD']);
        });
    }
}
