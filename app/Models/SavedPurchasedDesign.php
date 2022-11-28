<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Thiagoprz\CompositeKey\HasCompositeKey;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SavedPurchasedDesign extends Model
{
    use HasFactory, HasCompositeKey;

    protected $fillable = [
        'p_design_id', 'cus_id', 'sp_date_time'
    ];

    public $timestamps = true;

    public $incrementing = false;

    protected $primaryKey = ['p_design_id', 'cus_id'];
}
