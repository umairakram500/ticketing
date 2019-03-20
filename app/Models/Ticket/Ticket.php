<?php

namespace App\Models\Ticket;

use App\Models\Route\Stop;
use App\Models\Schedule;
use App\Models\Terminal;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
class Ticket extends Model
{
    use SoftDeletes;

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->company_id = 1;
            if(Auth::check()){
                $query->user_id = Auth::user()->id;
                $query->terminal_id = Auth::user()->terminal_id;
            }
        });


    }

    public function newQuery()
    {
        return parent::newQuery()->where([
            ['company_id', 1]
        ]);
    }


    /*----------------  RELATIONS  ----------------*/

    public function schedule(){
        return $this->belongsTo(Schedule::class);
    }

    public function route(){
        return $this->belongsTo(Route::class);
    }

    public function terminal(){
        return $this->belongsTo(Terminal::class);
    }

    public function bus(){
        return $this->belongsTo(Bus::class);
    }

    public function company(){
        return $this->belongsTo(Company::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function seats(){
        return $this->hasMany(TicketSeat::class);
    }

    public function type(){
        return $this->belongsTo(BookingType::class, 'btype_id');
    }

    public function fromStop(){
        return $this->belongsTo(Terminal::class, 'from_stop');
    }

    public function toStop(){
        return $this->belongsTo(Terminal::class, 'to_stop');
    }

    /*----------------  SCOPES  ----------------*/

    public function scopeSumof($query, $date, $paid = 2){

        if($paid == 0 || $paid == 1){
            $return = $query->where('paid',$paid)
                ->whereNotNull('seat_numbers')
                ->whereDate('booking_for', $date)
                ->sum('total_seats');
        } else {
            $return = $query->whereNotNull('seat_numbers')
                ->whereDate('booking_for', $date)
                ->sum('total_seats');
        }

        /*if($paid == 0 || $paid == 1) {
            $query->where('paid', $paid);
        }
        $query->whereNotNull('seat_numbers');
        $query->whereDate('booking_for', $date);
        $query->sum('total_seats');*/




        return $return;
    }

    public function scopeSeattypeSum($query, $date, $seat = 2){

        if($seat == 0){
            $return = $query->where('paid',1)
                ->whereNull('seat_numbers')
                ->whereDate('booking_for', $date)
                ->sum('total_seats');
        } else if($seat == 1) {
            $return = $query->where('paid',1)
                ->whereNotNull('seat_numbers')
                ->whereDate('booking_for', $date)
                ->sum('total_seats');
        } else {
            $return = $query->where('paid',1)
                ->whereDate('booking_for', $date)
                ->sum('total_seats');
        }

        return $return;
    }

    /*----------------  ATTRIBUTIES  ----------------*/

    public function getFromAttribute()
    {
        return $this->remarks!="" ? explode(' => ',$this->remarks)[0] : '';
    }
    public function getToAttribute()
    {
        return $this->remarks!="" ? explode(' => ',$this->remarks)[1] : '';
    }
    public function getIconAttribute()
    {
        //$icon = isset($this->type) ? $this->type->icon : '';
        return isset($this->type) ? '<span class="fa fa-'.$this->type->icon.'"></span> '.$this->type->title : '';
    }
}
