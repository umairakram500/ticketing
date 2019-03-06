<?php

namespace App\Models\Bus;

use App\Models\Route\Fare;
use App\Models\Schedule;
use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class LuxuryType extends Model
{

    use SoftDeletes, OptionsTrait;

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
        return parent::newQuery()->where('company_id', 1);
    }

    /*----------------  RELATIONS  ----------------*/

    public function fares(){
        return $this->hasMany(Fare::class, 'luxury_id');
    }

    public function buses(){
        return $this->hasMany(Bus::class, 'luxury_type_id');
    }

    public function schedules(){
        return $this->hasMany(Schedule::class, 'luxury_type');
    }

    /*----------------  SCOPES  ----------------*/

}
