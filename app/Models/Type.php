<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Type extends Model
{
    use HasFactory;

    protected $fillable = ['type_id', 'name', 'material', 'description', 'detail', 'price'];
    
    public $timestamps = true;

    public $incrementing = false;
    
    protected $primaryKey = 'type_id';

    //one type has many plainTeeTypeColor
    public function plainTeeTypeColors()
    {
        return $this->hasMany(PlainTeeTypeColor::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'type_id', 'length' => 7, 'prefix' => 'TY']);
        });
    }
}
