<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BoardingExpense extends Model
{
    protected $fillable = [
        'amount',
    ];

    public function boarding(){
        return $this->belongsTo(Boarding::class);
    }

    public function expense(){
        return $this->belongsTo(Expense::class);
    }


}
