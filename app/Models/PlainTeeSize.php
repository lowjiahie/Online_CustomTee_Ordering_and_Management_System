<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PlainTeeSize extends Model
{
    use HasFactory;

    protected $fillable = [
        'plain_tee_size_id', 'stocks', 'size_name', 'pt_type_color_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'plain_tee_size_id';

    //One PlainTeeSize has many OrderedCustomTees
    public function orderedCustomTees()
    {
        return $this->hasMany(OrderedCustomTee::class);
    }

    //Many PlainTeeSize belong to one plainTeeTypeColors
    public function plainTeeTypeColor()
    {
        return $this->belongsTo(PlainTeeTypeColor::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'plain_tee_size_id', 'length' => 7, 'prefix' => 'PS']);
        });
    }
}
