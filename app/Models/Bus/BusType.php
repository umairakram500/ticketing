<?php

namespace App\Models\Bus;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class BusType extends Model
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
            $query->company_id = Auth::user()->compnay_id;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where('company_id',1);
    }



    /*----------------  SCOPES  ----------------*/

    public function scopeOptions($query){
        return $query->addSelect(['id', 'title'])->where('status', 1)->get()->toArray();
    }

}
