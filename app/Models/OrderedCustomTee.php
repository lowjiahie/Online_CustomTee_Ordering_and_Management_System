<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderedCustomTee extends Model
{
    use HasFactory;

    protected $fillable = [
        'o_custom_tee_id', 'plain_tee_size_id', 'p_method_id', 'o_design_id', 'cus_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'o_custom_tee_id';

    //OrderedCustomTee one to many polymorphic orderItems
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderItemable');
    }

    //OrderedCustomTees belong to one printingMethods
    public function printingMethod()
    {
        return $this->belongsTo(PrintingMethod::class);
    }

    //OrderedCustomTees belong to one orderedDesigns
    public function orderDesign()
    {
        return $this->belongsTo(OrderDesign::class);
    }

    //OrderedCustomTees belong to one plainTeeSizes
    public function plainTeeSize()
    {
        return $this->belongsTo(PlainTeeSize::class);
    }

    //OrderedCustomTees belong to one customers
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->o_custom_tee_id = IdGenerator::generate(['table' => 'ordered_custom_tees', 'field' => 'o_custom_tee_id', 'length' => 7, 'prefix' => 'OT']);
        });
    }
}
