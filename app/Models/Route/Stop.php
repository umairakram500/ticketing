<?php

namespace App\Models\Route;

use App\Models\Terminal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Stop extends Model
{
    ////use SoftDeletes;

    protected $table = 'route_stops';

    protected $fillable = [
        'terminal_id', 'route_id', 'company_id', 'sort_order'
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
        return parent::newQuery()->where('company_id', 1)->orderBy('sort_order');
    }

    /*----------------  RELATIONS  ----------------*/

    public function stopovers(){
        return $this->hasMany(Stopover::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function terminal(){
        return $this->belongsTo(Terminal::class);
    }


    /*----------------  SCOPES  ----------------*/

    public function scopeOptions($query){
        return $query->addSelect(['id', 'title'])->get()->toArray();
    }

    public function scopeList($query, $val = 'title', $id = 'id')
    {
        $data = $query->addSelect([$id, $val])->where('status', 1)->get()->pluck($val, $id)->toArray();

        return (is_array($data) && count($data) )? $data : array();
    }


}
