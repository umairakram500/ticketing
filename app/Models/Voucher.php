<?php

namespace App\Models;

use App\Models\Bus\Bus;
use App\Models\Route\Route;
use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Voucher extends Model
{

    /*
     * Set the logged in user id on resource create in DB
     *
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->created_by = Auth::user()->id;
            $query->terminal_id = Auth::user()->terminal_id;
        });
    }

    public function boardings(){
        return $this->hasMany(Boarding::class);
    }

    public function routeExps(){
        return $this->hasMany( RouteExpense::class, 'voucher_id');
    }

    public function bus(){
        return $this->belongsTo(Bus::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function driver(){
        return $this->belongsTo(Staff::class, 'driver_id');
    }

    public function conductor(){
        return $this->belongsTo(Staff::class, 'conductor_id');
    }


}
