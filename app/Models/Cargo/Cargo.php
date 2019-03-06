<?php

namespace App\Models\Cargo;

use App\Models\City;
use App\Models\Terminal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Cargo extends Model
{
    //use SoftDeletes;

    protected $table = 'cargos';
    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
            $query->user_id = Auth::user()->id;
            $query->s_city = Auth::user()->city_id;
            $query->s_terminal = Auth::user()->terminal_id;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where([
            ['company_id', 1],
            //['terminal_id', Auth::user()->terminal_id]
        ]);
    }

    /*----------------  Relations  ----------------*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function senderTerminal(){
        return $this->belongsTo(Terminal::class, 's_terminal');
    }
    public function receiverTerminal(){
        return $this->belongsTo(Terminal::class, 'r_terminal');
    }

    public function senderCity(){
        return $this->belongsTo(City::class, 's_city');
    }
    public function receiverCity(){
        return $this->belongsTo(City::class, 'r_city');
    }

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function shipmentStatus()
    {
        return $this->belongsTo(ShipmentStatus::class);
    }

    public function items()
    {
        return $this->hasMany(CargoItem::class, 'cargo_id');
    }


}
