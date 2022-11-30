<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Color extends Model
{
    use HasFactory;

    protected $fillable = [
        'color_id', 'color_name', 'color_code'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'color_id';

    //One Color has many plainTeeTypeColors
    public function plainTeeTypeColors()
    {
        return $this->hasMany(PlainTeeTypeColors::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->color_id = IdGenerator::generate(['table' => 'colors', 'field' => 'color_id', 'length' => 7, 'prefix' => 'CL']);
        });
    }
}
