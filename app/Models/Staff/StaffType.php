<?php

namespace App\Models\Staff;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class StaffType extends Model
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

    public function staff()
    {
        return $this->hasMany(Staff::class, 'staff_type_id');
    }

    /*----------------  SCOPES  ----------------*/

    public function scopeOptions($query){
        return $query->addSelect(['id', 'title'])->where('status', 1)->get()->toArray();
    }


}
