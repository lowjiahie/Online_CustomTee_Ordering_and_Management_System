<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlainTeeTypeColor extends Model
{
    use HasFactory;

    protected $fillable = [
        'pt_type_color_id', 'plain_tee_img', 'color_id', 'type_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'pt_type_color_id';

    //One plainTeeTypeColor has many plainTeeSizes
    public function plainTeeSizes()
    {
        return $this->hasMany(PlainTeeSize::class);
    }

    //One plainTeeTypeColor belongToMany customers
    public function customers()
    {
        return $this->belongsToMany(Customer::class, 'custom_tee_designs');
    }

    //Many plainTeeTypeColors belong to one type
    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    //Many plainTeeTypeColors belong to one color
    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->pt_type_color_id = IdGenerator::generate(['table' => 'plain_tee_type_colors', 'field' => 'pt_type_color_id', 'length' => 7, 'prefix' => 'TC']);
        });
    }
}
