<?php

namespace App\Models\Ticket;

use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TicketSeat extends Model
{
    //use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gender', 'seat', 'schedule_id', 'from_sort', 'to_sort'
    ];

    public function ticket(){
        return $this->belongsTo(Ticket::class);
    }

    public function scopeSelection($query, $val = 'gender', $id = 'seat')
    {
        $data = $query->addSelect([$id, $val])->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }
}
