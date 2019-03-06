<?php

namespace App\Models\Route;

use App\Models\Bus\LuxuryType;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth, DB;

class Fare extends Model
{
    //use SoftDeletes;

    protected $table = 'route_fares';

    protected $fillable = [
        'route_id', 'luxury_id', 'fare'
    ];

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where([
            ['company_id', 1]
        ]);
    }

    /*----------------  RELATIONS  ----------------*/

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function luxury(){
        return $this->belongsTo(LuxuryType::class, 'luxury_id');
    }

    public function scopeOptions($query){
        return $query->addSelect(['luxury_id as id', 'fare'])->get()->toArray();
    }

    public function scopeFares($query){
        return $query->select(DB::raw("CONCAT(route_id,'-',luxury_id,'-',from_terminal_id,'-',to_terminal_id) AS fare_id"),'kms', 'fare');
    }


}
