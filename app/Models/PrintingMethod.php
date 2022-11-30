<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PrintingMethod extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_method_id', 'name', 'price', 'minimum_order', 'status'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'p_method_id';

    //One Printing Method has many OrderedCustomTees
    public function orderCustomTees()
    {
        return $this->hasMany(OrderedCustomTee::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->p_method_id = IdGenerator::generate(['table' => 'printing_methods', 'field' => 'p_method_id', 'length' => 7, 'prefix' => 'PM']);
        });
    }
}
