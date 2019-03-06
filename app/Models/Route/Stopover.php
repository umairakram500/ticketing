<?php

namespace App\Models\Route;

use App\Models\Staff\Staff;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Stopover extends Model
{
    ////use SoftDeletes;

    protected $table = 'route_stopovers';

    protected $fillable = [
        'from_stop_id', 'to_stop_id', 'fare', 'kms', 'travel_time', 'route_id', 'company_id'
    ];

    /*
     * Set the logged in user id on resource create in DB
     *
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = Auth::user()->company_id;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where('company_id', 1);
    }

    /*----------------  RELATIONS  ----------------*/

    public function from_stop(){
        return $this->belongsTo(Stop::class, 'from_stop_id');
    }

    public function to_stop(){
        return $this->belongsTo(Stop::class, 'to_stop_id');
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    /*----------------  SCOPES  ----------------*/



}
