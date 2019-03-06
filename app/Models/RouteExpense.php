<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RouteExpense extends Model
{
    protected $fillable = [
       'bus_id', 'exptype_id', 'amount' , 'voucher_id'
    ];

    public function voucher(){
        return $this->belongsTo(Voucher::class, 'voucher_id');
    }

    public function expense_type(){
        return $this->belongsTo(ExpenseType::class, 'exptype_id');
    }


}
