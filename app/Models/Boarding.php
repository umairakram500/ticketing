<?php

namespace App\Models;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use App\Models\Route\Route;
use App\Models\Bus\Bus;
use App\Models\Ticket\Ticket;
use App\Models\City;
use App\Models\Terminal;
use App\Models\Schedule;
use Auth;

class Boarding extends Model
{

    /*
     * Set the logged in user id on resource create in DB
     *
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = Auth::user()->id;
        });
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }
    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function bus(){
        return $this->belongsTo(Bus::class);
    }

    public function expenses(){
        return $this->hasMany(BoardingExpense::class);
    }

    public function terminal(){
        return $this->belongsTo(Terminal::class, 'from_terminal');
    }
    public function from(){
        return $this->belongsTo(Terminal::class, 'from_terminal');
    }
    public function to(){
        return $this->belongsTo(Terminal::class, 'to_terminal');
    }
    public function fromcity(){
        return $this->belongsTo(City::class, 'from_city');
    }
    public function tocity(){
        return $this->belongsTo(City::class, 'to_city');
    }

    public function driver()
    {
        return $this->belongsTo(Staff::class, 'driver_id');
    }

    public function conductor()
    {
        return $this->belongsTo(Staff::class, 'conductor_id');
    }

    public function scopeExplist()
    {
        return $this->expenses()->get()->pluck('amount', 'id')->toArray();
    }

    public function voucher(){
        return $this->belongsTo( Voucher::class );
    }


}
