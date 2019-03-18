<?php

namespace App\Models;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;


class City extends Model
{

    use SoftDeletes, OptionsTrait;

    /*
     * Set the logged in user id on resource create in DB
     *
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

    public function user(){
        return $this->hasMany(User::class);
    }

    public function from_city(){
        return $this->hasMany(City::class, 'from_city_id');
    }

    public function to_city(){
        return $this->hasMany(City::class, 'to_city_id');
    }

    public function terminal(){
        return $this->hasMany(Terminal::class);
    }

    /*----------------  SCOPES  ----------------*/


}
