<?php

namespace App\Models;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class ExpenseType extends Model
{
    //use SoftDeletes;
    use OptionsTrait;

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
        return $this->belongsTo(User::class);
    }

    public function expenses(){
        return $this->hasMany(Expense::class);
    }

    public function route_expenses(){
        return $this->hasMany(RouteExpense::class, 'exptype_id');
    }

    /*----------------  SCOPES  ----------------*/

    public function scopeTerminal($query){
        return $query->where('terminal_deduct', 1);
    }

    public function scopeTerminalExp($query, $val = 'title', $id = 'id')
    {
        $data = $query->addSelect([$id, $val])->where([
            ['status', 1],
            ['terminal_deduct', 1]
        ])->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }


}
