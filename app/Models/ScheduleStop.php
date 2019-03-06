<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScheduleStop extends Model
{

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

    public function stops(){
        return $this->belongsTo(Schedule::$booted);
    }
}
