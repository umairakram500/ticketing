<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //use SoftDeletes;

    protected $fillable = [
        'name', 'cnic', 'phone','address', 'city_id', 'booking_count', 'travel_count'
    ];
}
