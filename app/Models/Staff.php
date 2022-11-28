<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Staff extends Model
{
    use HasFactory;

    protected $fillable = [
        'staff_id', 'name', 'email', 'password', 'gender', 'date_of_birth','phone_no','role'
    ];

    public $timestamps = true;

    public $incrementing = false;
    
    protected $primaryKey = 'staff_id';

    //One staff can create many competitions
    public function competitions()
    {
        return $this->hasMany(Staff::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'staff_id', 'length' => 7, 'prefix' => 'SF']);
        });
    }
}
