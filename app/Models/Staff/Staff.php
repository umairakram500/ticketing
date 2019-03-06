<?php

namespace App\Models\Staff;

use App\Models\Boarding;
use App\Models\Bus\Bus;
use App\Models\Voucher;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Staff extends Model
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
            $query->company_id = 1;
            $query->terminal_id = Auth::user()->terminal_id;
            $query->city_id = Auth::user()->city_id;
        });
    }


    /*----------------  Relations  ----------------*/

    public function buses()
    {
        return $this->hasMany(Bus::class);
    }

    public function schedules()
    {
        return $this->hasMany(Schedule::class);
    }

    public function type()
    {
        return $this->belongsTo(StaffType::class, 'staff_type_id');
    }

    public function boardings(){
        return $this->hasMany(Boarding::class);
    }

    public function vouchers(){
        return $this->hasMany(Voucher::class);
    }




    /*----------------  SCOPES  ----------------*/

    public function scopeDriverOptions($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 1],
            ['status', 1]
        ])->get()->toArray();
    }

    public function scopeConductorOptions($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 2],
            ['status', 1]
        ])->get()->toArray();
    }

    public function scopeTerminalDriverOptions($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 1],
            ['status', 1],
            ['terminal_id', Auth::user()->terminal_id]
        ])->get()->toArray();
    }

    public function scopeTerminalConductorOptions($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 2],
            ['status', 1],
            ['terminal_id', Auth::user()->terminal_id]
        ])->get()->toArray();
    }

    public function scopeDriverList($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 1],
            ['status', 1]
        ])->get()->pluck('name', 'id')->toArray();
    }

    public function scopeConductorList($query){
        return $query->addSelect(['id', 'name'])->where([
            ['staff_type_id', 2],
            ['status', 1]
        ])->get()->pluck('name', 'id')->toArray();
    }



    /*----------------  ATTRIBUTES  ----------------*/


}
