<?php

namespace App\Models;

use App\Models\Route\Stop;
use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Terminal extends Model
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
        return parent::newQuery()->where([
            ['company_id', 1]
        ]);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function city(){
        return $this->belongsTo(City::class);
    }

    public function buses(){
        return $this->hasMany(Bus::class);
    }

    public function boardings(){
        return $this->hasMany(Boarding::class, 'from_terminal');
    }

    public function stops(){
        return $this->hasMany(Stop::class);
    }

    public function expenses(){
        return $this->hasMany(ExpensetypeTerminal::class);
    }

    /*----------------  SCOPES  ----------------*/



}
