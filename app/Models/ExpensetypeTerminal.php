<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExpensetypeTerminal extends Model
{
    protected $table = 'expensetypes_terminals';
    protected $fillable = [
        'expensetype_id', 'terminal_id', 'amount'
    ];
}
