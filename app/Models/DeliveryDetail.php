<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DeliveryDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_detail_id', 'delivery_tracking_num', 'delivery_service', 'status'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'delivery_detail_id';

    //one deliveryDetail belongTo one order
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'delivery_detail_id', 'length' => 7, 'prefix' => 'DE']);
        });
    }
}
