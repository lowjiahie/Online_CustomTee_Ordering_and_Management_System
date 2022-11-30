<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PublishedDesignReport extends Model
{
    use HasFactory;

    protected $fillable = [
        'p_design_report_id', 'title', 'description', 'cus_id', 'p_design_id'
    ];

    public $timestamps = true;

    public $incrementing = false;
    
    protected $primaryKey = 'p_design_report_id';

    //published design reports belong to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    //published design reports belong to published design
    public function publishedDesign()
    {
        return $this->belongsTo(PublishedDesign::class);
    }

    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->p_design_report_id = IdGenerator::generate(['table' => 'published_design_reports', 'field' => 'p_design_report_id', 'length' => 7, 'prefix' => 'DR']);
        });
    }
}
