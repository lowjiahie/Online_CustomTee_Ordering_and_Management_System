<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaypalAccount extends Model
{
    use HasFactory;

    protected $fillable = [
        'paypal_acc_id', 'first_name', 'last_name', 'email_id', 'phone_num', 'cus_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'paypal_acc_id';

    //paypalAccount belong to customer 
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->paypal_acc_id = IdGenerator::generate(['table' => 'paypal_accounts', 'field' => 'paypal_acc_id', 'length' => 7, 'prefix' => 'PA']);
        });
    }
}
