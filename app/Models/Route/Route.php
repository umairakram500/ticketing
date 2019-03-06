<?php

namespace App\Models\Route;

use App\Models\Boarding;
use App\Models\Bus\Bus;
use App\Models\City;
use App\Models\Schedule;
use App\Models\Terminal;
use App\Models\User;
use App\Models\Voucher;
use App\Traits\CommenFunctions;
use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Route extends Model
{

    use SoftDeletes, CommenFunctions, OptionsTrait;

    protected $fillable = [
        'title', 'from_city_id', 'to_city_id',
        'from_terminal_id', 'to_terminal_id', 'status',
        'stations', 'travel_time', 'fare'
    ];

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = Auth::user()->id;
            $query->company_id = Auth::user()->company_id;
        });
    }

    public function newQuery()
    {
        $where['company_id'] = 1;
        return parent::newQuery()->where($where);
    }


    /*----------------  RELATIONS  ----------------*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function from_city(){
        return $this->belongsTo(City::class, 'from_city_id');
    }

    public function to_city(){
        return $this->belongsTo(City::class, 'to_city_id');
    }

    public function from_terminal(){
        return $this->belongsTo(Terminal::class, 'from_terminal_id');
    }

    public function to_terminal(){
        return $this->belongsTo(Terminal::class, 'to_terminal_id');
    }

    public function buses(){
        return $this->hasMany(Bus::class, 'route_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class);
    }

    public function stops(){
        return $this->hasMany(Stop::class);
    }

    public function stopovers(){
        return $this->hasMany(Stopover::class);
    }

    public function fares(){
        return $this->hasMany(Fare::class);
    }

    public function boardings(){
        return $this->hasMany(Boarding::class);
    }


    /*----------------  SCOPES  ----------------*/

    public function scopeFromUserTerminal($query){
        return $query->where('from_terminal_id', Auth::user()->terminal_id);
    }

    public function scopeVerify($query){
        return $query->where([
            ['from_city_id', $this->from_city_id],
            ['to_city_id', $this->to_city_id],
            ['from_terminal_id', $this->from_terminal_id],
            ['to_terminal_id', $this->to_terminal_id],
        ])->exists();
    }

    public function scopeStopsList()
    {
        return $this->stops()->with('terminal')->get()
            ->pluck('terminal.title', 'terminal_id')->toArray();
    }
    
    public function scopeSchedulesList()
    {
        return $this->schedules()->get()->pluck('depart_time', 'id')->toArray();
    }

    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }


    /*----------------  ATTRIBUTES  ----------------*/

    public function getTravelHrsAttribute()
    {
        return explode(':',$this->travel_time)[0];
    }
    public function getTravelMinsAttribute()
    {
        return explode(':',$this->travel_time)[1];
    }
    public function getTravelTimeDisplayAttribute()
    {
        return str_replace(':','h ', $this->travel_time)."m";
    }
    public function getStationAttribute()
    {
        $stations = json_decode($this->stations);
        if(is_array($stations) && count($stations))
            return $this->toSelect(City::whereIn('id', $stations)->get()->toArray(), 'name');
        else
            return array();
    }




}
