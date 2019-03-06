<?php

namespace App\Models\Ticket;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;

class BookingType extends Model
{
    use OptionsTrait;

    public function type(){
        return $this->hasMany(Ticket::class, 'btype_id');
    }
}
