<?php

namespace App\Http\Controllers\front;

use App\Http\Requests\DoBooking;
use App\Models\Schedule;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketSeat;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Schedule $schedule)
    {
        $seats = array(34, 35) ;
        /*$tickets = Schedule::with('seats', function($q) use ($seats){
            $q->whereNotIn('seat', $seats);
        })->get();*/
        /*$tickets = Schedule::whereHas('seats', function($q) use($seats) {
            $q->whereIn('seat', $seats);
        })->get();*/
        dd($schedule->seats()->whereIn('seat', $seats)->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Schedule $schedule, DoBooking $request)
    {
        $ticket = new Ticket();

        $ticket->p_phone = $request->p_phone;
        $ticket->p_name = $request->p_name;
        $ticket->p_cnic = $request->p_cnic;
        $ticket->total_seats = $request->total_seats;
        $ticket->seat_numbers = $request->seat_numbers;
        $ticket->remarks = $request->remarks;
        $ticket->from_city_id = $request->from_city_id;
        $ticket->to_city_id = $request->to_city_id;
        $ticket->fare = $request->schedule->fare;
        $ticket->total_fare = $request->schedule->fare*$request->total_seats;
        $ticket->bus_id = $request->schedule->bus_id;
        $ticket->route_id = $request->schedule->route_id;
        $ticket->schedule_id = $request->schedule->id;
        $ticket->btype_id = isset($request->type_id) ? $request->type_id : 1;

        if(Auth::check()){
            $ticket->user_id = Auth::user()->id;
        }

       //dd($request->all());

        /*if(1==0){
            return redirect()->back()->withInput();
        }
        else*/
            if($ticket->save()){

            $schedule->avail_seats -= count($request->seat);
            $schedule->save();

            $seats = array();
            foreach($request->seat as $seat_no => $gendor){
                $seat['seat'] = $seat_no;
                $seat['gender'] = $gendor;
                $seats[] = new TicketSeat($seat);
            }
            $ticket->seats()->saveMany($seats);

            Session::flash('ticket_id', $ticket->id);
            Session::flash('flash_success', 'Ticket added successfully');
            return redirect()->route('front.ticket.success');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['ticket'] =  Session::get( 'flash_success' );
        return view('front.booking.success');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function success()
    {
        $data['ticket_id'] =  Session::get( 'ticket_id' );
        return view('front.booking.success', $data);
    }
}
