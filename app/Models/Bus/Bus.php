<?php

namespace App\Models\Bus;

use App\Models\Boarding;
use App\Models\Staff\Staff;
use App\Models\Schedule;
use App\Models\Route\Route;
use App\Models\Terminal;
use App\Models\User;
use App\Models\Voucher;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class Bus extends Model
{
    //use SoftDeletes;

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = Auth::user()->id;
            $query->company_id = Auth::user()->company_id;
            $query->terminal_id = Auth::user()->terminal_id;
            $query->city_id = Auth::user()->city_id;
        });
    }

    public function newQuery()
    {
        $where['company_id'] = 1;
        return parent::newQuery()->where($where);
    }

    /*----------------  Relations  ----------------*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function route(){
        return $this->belongsTo(Route::class, 'route_id');
    }

    public function terminal(){
        return $this->belongsTo(Terminal::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function schedule()
    {
        return $this->schedules()->where([
            ['status', 1],
            ['arrived', 0]
        ])->oldest();
    }

    public function driver()
    {
        return $this->belongsTo(Staff::class, 'driver_id');
    }

    public function conductor()
    {
        return $this->belongsTo(Staff::class, 'conductor_id');
    }

    public function luxury()
    {
        return $this->belongsTo(LuxuryType::class, 'luxury_type_id');
    }

    public function boardings()
    {
        return $this->hasMany(Boarding::class);
    }

    public function vouchers()
    {
        return $this->hasMany(Voucher::class);
    }


    /*----------------  SCOPES  ----------------*/

    public function scopeOnUserTerminal()
    {
        return $this->where([
            ['terminal_id', Auth::user()->terminal_id],
            ['status', 1]
        ]);
    }

    public function scopeHasSchedule()
    {
        return $this->whereHas('schedules', function ($query) {
            $query->where([
                ['arrived', 0]
            ]);
        })->withCount('schedules')->oldest();

        //return $this->has('schedules');
    }

    public function scopeNoSchedule()
    {
        return $this->whereHas('schedules');;
    }

    public function scopeOptions($query){
        return $query->addSelect(['id', DB::raw("CONCAT(title,' - ',number) AS title")])->where('status', 1)->get()
            ->toArray();
    }

    public function scopeList($query){
        return $query->addSelect(['id', DB::raw("CONCAT(title,' - ',number) AS title")])->where('status', 1)->get()
            ->pluck('title', 'id')->toArray();
    }


}
