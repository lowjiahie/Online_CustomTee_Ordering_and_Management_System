<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublishedDesign extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_design_id', 'name', 'description', 'price', 'status', 'reason_banned_denied', 'type', 'front_design_img',
        'back_design_img', 'front_design_json', 'back_design_json', 'cus_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'p_design_id';

    //published designs belong to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //publishedDesign one to many polymorphic orderItems
    public function orderItems()
    {
        return $this->morphMany(OrderItem::class, 'orderItemable');
    }

    //publishedDesign has many PublishedDesignReports
    public function publishedDesignReports()
    {
        return $this->hasMany(PublishedDesignReport::class);
    }

    //publishedDesign belongToMany customers (pivot -SavedPurchasedDesigns)
    public function savedPurchasedDesigns()
    {
        return $this->belongsToMany(Customer::class, 'saved_purchased_designs');
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'p_design_id', 'length' => 7, 'prefix' => 'PD']);
        });
    }
}
