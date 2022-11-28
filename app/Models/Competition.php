<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Competition extends Model
{
    use HasFactory;

    protected $fillable = [
        'competition_id', 'topic', 'description', 'rules', 'start_date_time', 
        'end_date_time', 'winner', 'staff_id'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = 'competition_id';

    //One competition belongToMany customers (pivot - participants)
    public function participants()
    {
        return $this->belongsToMany(Customer::class, 'participants');
    }

    //Competitions belong to one staff
    public function staff()
    {
        return $this->belongsTo(Staff::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = IdGenerator::generate(['table' => $this->table, 'field' => 'competition_id', 'length' => 7, 'prefix' => 'CN']);
        });
    }
}
