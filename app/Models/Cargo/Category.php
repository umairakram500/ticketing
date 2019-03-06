<?php

namespace App\Models\Cargo;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Category extends Model
{
    //use SoftDeletes;

    protected $table = 'cargo_categories';
    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
            $query->user_id = Auth::user()->id;
        });
    }

    public function newQuery()
    {
        return parent::newQuery()->where([
            ['company_id',1],
            //['terminal_id', Auth::user()->terminal_id]
        ]);
    }

    /*----------------  SCOPES  ----------------*/

    public function scopeOptions($query){
        return $query->addSelect(['id', 'title'])->where('status', 1)->get()->toArray();
    }
}
