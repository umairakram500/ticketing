<?php

namespace App\Models;

use App\Models\Bus\Bus;
use App\Models\Bus\LuxuryType;
use App\Models\Staff\Staff;
use App\Models\Route\Route;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketSeat;
use App\Traits\OptionsTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Auth;
//use Illuminate\Support\Facades\Route;

class Schedule extends Model
{
    //use SoftDeletes;
    use OptionsTrait;

    /*
     * Set the logged in user id on resource create in DB
     * */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($query) {
            $query->user_id = Auth::user()->id;
            $query->company_id = 1;
            //$query->terminal_id = Auth::user()->terminal_id;
            //$query->city_id = Auth::user()->city_id;
        });
    }


    /*----------------  Relations  ----------------*/
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
    public function luxuryType(){
        return $this->belongsTo(LuxuryType::class, 'luxury_type');
    }

    public function stops(){
        return $this->hasMany(ScheduleStop::class);
    }

    public function buses()
    {
        return $this->belongsTo(Bus::class, 'bus_id');
    }
    public function bus()
    {
        return $this->belongsTo(Bus::class);
    }
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
    
    public function ticketSum()
    {
        return $this->tickets()->selectRaw('tickets.btype_id,SUM(tickets.total_seats) as total') ->groupBy
        ('tickets.btype_id');
    }
    public function ticketStops($date)
    {
        return $this->tickets()->whereDate('booking_for', $date)
            ->selectRaw('tickets.to_stop,SUM(tickets.total_seats) as total_seats, SUM(tickets.total_fare) as total_fare, SUM(tickets.discount) as total_discount, STUFF((SELECT \',\' + md.seat_numbers FROM tickets md WHERE md.to_stop = tickets.to_stop
          FOR XML PATH(\'\'), TYPE).value(\'.\', \'NVARCHAR(MAX)\'), 1, 1, \'\') as seat_numbers')
            ->groupBy('tickets.to_stop');
    }

    public function bookingSum($bookingdate)
    {
        return $this->tickets()->whereDate('booking_for', $bookingdate)
            ->selectRaw('tickets.paid,SUM(tickets.total_seats) as total')
            ->groupBy('tickets.paid');
    }
    public function issueSum($issueDate)
    {
        return $this->tickets()->whereDate('booking_for', $issueDate)
            ->selectRaw('tickets.paid,SUM(tickets.total_seats) as total')
            ->groupBy('tickets.paid');
    }

    public function ticketsDepart()
    {
        return $this->hasMany(Ticket::class)->where('departure', 1);
    }
    public function ticketsRetrun()
    {
        return $this->hasMany(Ticket::class)->where('departure', 0);
    }

    public function fareSum()
    {
        return $this->tickets()
            ->selectRaw('tickets.schedule_id, SUM(tickets.total_fare) as total')
            ->groupBy('tickets.schedule_id');
    }

    public function voucherTickets()
    {
        return $this->tickets()->where('voucher_no', $this->voucher_no);
    }

    public function driver()
    {
        return $this->belongsTo(Staff::class, 'driver_id');
    }

    public function conductor()
    {
        return $this->belongsTo(Staff::class, 'conductor_id');
    }

    /**
     * Get all of the ticket seat for the Schedule.
     */
    public function seats()
    {
        return $this->hasManyThrough(TicketSeat::class, Ticket::class);
    }

    // All Expenses
    public function expenses()
    {
        return $this->hasMany(Expense::class);
    }
    // Depart Dexpenses
    public function expenseDepart()
    {
        return $this->hasMany(Expense::class)->where('departure', 1);
    }
    // Return Exppenses
    public function expenseReturn()
    {
        return $this->hasMany(Expense::class)->where('departure', 0);
    }

    public function boardings()
    {
        return $this->hasMany(Boarding::class);
    }
    /*----------------  SCOPES  ----------------*/

    public function scopeStopsData($query)
    {

        return $data = $this->stops()->with('terminal')->get()->toArray();

        return (is_array($data) && count($data) )? array_combine(array_column($data, $id), array_column($data, $val))
            : array();
    }

}
