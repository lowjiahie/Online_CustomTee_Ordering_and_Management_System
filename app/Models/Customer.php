<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\Contracts\HasApiTokens;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     * want to insert the field by specify the attribute name
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'phone_num',
        'address'
    ];

    /**
     * $guardeed
     * want to ignore to insert the field by specify the attribute name
     */

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Relationship
     */

    //One customer has one paypalaccount
    public function paypalAccount()
    {
        return $this->hasOne(PaypalAccount::class);
    }

    //One Customer has many orders
    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    //One Customer has many published designs
    public function publishedDesigns()
    {
        return $this->hasMany(PublishedDesign::class);
    }

    //One Customer has many publised design reports
    public function publishedDesignReports()
    {
        return $this->hasMany(PublishedDesignReport::class);
    }

    //One Customer belongsToMany publishedDesigns (pivot - savedPurchasedDesigns)
    public function savedPurchasedDesigns()
    {
        return $this->belongsToMany(PublishedDesign::class, 'saved_purchased_designs');
    }

    //One Customer belongToMany competitions (pivot - participants)
    public function participants()
    {
        return $this->belongsToMany(Competition::class, 'participants');
    }

    //One Customer belongsToMany plainTeeTypeColors (pivot - customTeeDesigns)
    public function plainTeeTypeColors()
    {
        return $this->belongsToMany(PlainTeeTypeColor::class, 'custom_tee_designs');
    }

    //One customer has many ordered custom tees
    public function orderedCustomTees()
    {
        return $this->hasMany(OrderedCustomTee::class);
    }
}
