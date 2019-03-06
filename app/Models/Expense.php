<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;

class Expense extends Model
{
    ////use SoftDeletes;

    protected $fillable = [
        'amount', 'expense_type_id', 'status','schedule_id', 'departure'
    ];

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

    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }

    public function expense_type()
    {
        return $this->belongsTo(ExpenseType::class);
    }



    /*----------------  SCOPES  ----------------*/


}
