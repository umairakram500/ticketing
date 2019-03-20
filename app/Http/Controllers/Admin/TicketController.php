<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\TicketBook;
use App\Models\Customer;
use App\Models\Route\Fare;
use App\Models\Route\Route;
use App\Models\Route\Stop;
use App\Models\Terminal;
use App\Models\Ticket\Ticket;
use App\Models\Ticket\TicketSeat;
use App\Traits\CommenFunctions;
use Illuminate\Support\Facades\Session;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    use CommenFunctions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /*
     *
    public function index(Schedule $schedule)
    {
        $data['schedule'] = $schedule;
        return view('admin.schedule.ticketList', $data);
    }
    */

    public function index()
    {
        return view('admin.ticket.index');
    }

    public function booking()
    {
        return view('admin.ticket.booking');
    }

    public function ticketing(Request $req)
    {
        //dd($req->schid);
        $data['schedule_id'] = null;
        $data['route'] = null;
        $data['bookingdate'] = null;
        if (isset($req->schid)) {
            $schedule = Schedule::find($req->schid);
            $data['schedule_id'] = $schedule->id;
            $data['route'] = $schedule->route_id;
            $routefares = Fare::where('route_id', $schedule->route_id)->get()->toArray();
            if (count($routefares)) {
                foreach ($routefares as $fare) {
                    $data['fares'][$fare['luxury_id']][] = $fare;
                }
            }
            if (isset($data['fares'][$schedule->luxury_type])) {
                $data['stopovers'] = $data['fares'][$schedule->luxury_type];
            }
            //dd($data['fares']);


            if (isset($req->bkd))
                $data['bookingdate'] = date('Y-m-d', strtotime($req->bkd));
        }

        return view('admin.ticket.ticketing', $data);
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(TicketBook $request)
    {
        // dd($request->all());
        // Check selected seats are available
        $schedule = Schedule::find($request->schedule_id);
        $bookingdate = $request->booking_date;
        $from_sort = Stop::where([
            ['route_id',$request->route],
            ['terminal_id',$request->from_stop]
        ])->get()->first()->sort_order;
        $to_sort = Stop::where([
            ['route_id',$request->route],
            ['terminal_id',$request->to_stop]
        ])->get()->first()->sort_order;

        if (isset($request->seat)) {
            /*$checkSeats = $schedule->seats()->where([
                ['to_sort', '>', $from_sort],
                ['from_sort', '<=', $from_sort],
            ])->whereHas('ticket', function ($query) use ($bookingdate) {
                return $query->whereDate('booking_for', $bookingdate);
            })->whereIn('seat', array_keys($request->seat))->get()->toArray();*/

            //dd(array_keys($request->seat));
            $checkSeats = TicketSeat::where([
                        ['to_sort', '>', $from_sort],
                        ['from_sort', '<=', $from_sort],
                    ])
                    ->whereHas('ticket', function ($query) use ($schedule, $bookingdate) {
                        return $query->where('schedule_id', $schedule->id)
                            ->whereDate('booking_for', $bookingdate);
                    })->whereIn('seat', array_keys($request->seat))->get()->toArray();

            //dd($checkSeats);

            $bookedseats = $this->toSelect($checkSeats, 'seat');
            if (count($bookedseats) > 0) {
                Session::flash('seat_error', 'Seat\'s(' . implode(',', $bookedseats) . ') not available');
                return redirect()->back()->withInput();
            }
        }

        // set ticket data
        $ticket = new Ticket();
        $ticket->p_phone = $request->p_phone;
        $ticket->p_name = $request->p_name;
        $ticket->p_cnic = $request->p_cnic;
        $ticket->total_seats = $request->total_seats;
        $ticket->seat_numbers = $request->seat_numbers;
        //$ticket->remarks = $request->remarks;
        $ticket->from_city_id =Terminal::find($request->from_stop)->city_id;
        $ticket->to_city_id = Terminal::find($request->to_stop)->city_id;;
        $ticket->from_stop = $request->from_stop;
        $ticket->to_stop = $request->to_stop;
        $ticket->fare = $request->fare;
        $ticket->total_fare = $request->fare * $request->total_seats;
        $ticket->discount = $request->discount;
        //$ticket->bus_id = $schedule->bus_id;
        $ticket->route_id = $schedule->route_id;
        $ticket->schedule_id = $schedule->id;
        $ticket->btype_id = 2;
        $ticket->paid = $request->paid ? 1 : 0;
        $ticket->booking_for = $request->booking_date . ' ' . date('H:m:i', strtotime($schedule->depart_time));
        $ticket->from_sort = $from_sort;
        $ticket->to_sort = $to_sort;

        // dd($ticket->toArray());

        // Get customer id if CNIC is exiting otherwise create new customer
        $customer = Customer::updateOrCreate(['cnic' => $request->p_cnic], [
            'name' => $request->p_name,
            'phone' => $request->p_phone
        ]);
        $ticket->customer_id = $customer->id;

        if ($ticket->save()) {

            $customer->booking_count = $customer->booking_count + 1;
            $customer->save();

            if (is_array($request->seat)) {
                // $schedule->avail_seats -= count($request->seat);
                // $schedule->save();

                $seats = array();
                foreach ($request->seat as $seat_no => $gendor) {
                    $seat['seat'] = $seat_no;
                    $seat['gender'] = $gendor;
                    $seat['type'] = $ticket->btype_id;
                    $seat['from_sort'] = $from_sort;
                    $seat['to_sort'] = $to_sort;
                    $seats[] = new TicketSeat($seat);
                }
                $ticket->seats()->saveMany($seats);
            }
            $msg = $ticket->paid ? 'Ticket added successfully' : 'Seat(s) booked successfully.\nBooking ID: '.$ticket->id;
            Session::flash('flash_success', $msg);
            if (!$ticket->paid)
                return redirect()->back()->withInput([
                    'booking_date' => $request->booking_date,
                    'route' => $request->route ,
                    'from_stop' => $request->from_stop ,
                    'to_stop' => $request->to_stop ,
                    'route_id' => $request->route_id ,
                    'schedule_id' => $request->schedule_id ,
                ]);
            else
                return redirect()->route('admin.ticket.show', $ticket->id);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($ticket)
    {

        $ticket = Ticket::find($ticket);
        if ($ticket == null) {
            return redirect()->back()->with('flash_error', 'Entered Ticket ID not found');
        } else if ($ticket->paid == 0) {
            return redirect()->back()->with('flash_error', 'Entered Ticket ID not yet paid');
        }
        $schedule = Schedule::find($ticket->schedule_id);

        $route = Route::find($schedule->route_id);
        //print_r($route->title); exit;
        return view('admin.ticket.print', compact('ticket', 'route', 'schedule'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Ticket $ticket)
    {
        /*$schedule->avail_seats += $ticket->total_seats;
        $schedule->save();*/
        $ticket->seats()->delete();
        $ticket->delete();
        return response(['status' => 1, 'msg' => 'Ticket Successfully Cancelled']);
    }

    /**
     * Change paid status the specified resource from storage.
     *
     * @param  Ticket $ticket
     * @return \Illuminate\Http\Response
     */
    public function paid(Ticket $ticket)
    {
        $ticket->paid = 1;
        $ticket->save();
        return response($ticket);
    }

    // Get schedules list for booking and ticketing
    public function getSchedules(Request $req)
    {

        $data['bookingdate'] = $req->bookingdate;
        $data['schedules'] = Schedule::where('route_id', $req->route)->get();
        return view('admin.ticket.getSchedules', $data);
    }

    // get bus seats with route and schedules
    public function getBusSeats(Request $req)
    {
        $schedule = $req->schedule;
        $date = $req->bookingdate;

        $from_sort = Stop::where([
            ['route_id', $req->route],
            ['terminal_id', $req->from_stop]
        ])->get()->first()->sort_order;
        /*$to_sort = Stop::where([
            ['route_id', $req->route],
            ['terminal_id', $req->to_stop]
        ])->get()->first()->sort_order;*/

        //dd($from_sort);

        $seats = TicketSeat::where([
                    ['to_sort', '>', $from_sort],
                    ['from_sort', '<=', $from_sort],
                ])
            ->whereHas('ticket', function ($query) use ($schedule, $date) {
                return $query->where('schedule_id', $schedule)
                             ->whereDate('booking_for', $date);
            })->get()->toArray();

        //dd($seats);

        $schedule = Schedule::find($req->schedule);
        $data['schedule'] = $schedule;
        $data['seats'] = $this->toSelect($seats, 'gender', 'seat');
        /* $data['btypes'] = $this->toSelect($schedule->seats()->whereHas('ticket', function($query) use ($schedule, $date){
             return $query->whereDate('booking_for', $date);
         })->addSelect(['seat', 'tickets.btype_id'])->get()->toArray(), 'btype_id', 'seat');*/
        $data['paid'] = $this->toSelect($schedule->seats()->whereHas('ticket', function ($query) use ($schedule, $date) {
            return $query->whereDate('booking_for', $date);
        })->addSelect(['seat', 'tickets.paid'])->get()->toArray(), 'paid', 'seat');

        return view('admin.ticket.getBusSeats', $data);
        //return response($schedules);
    }

    // Get Ticket info and canel ticket
    public function cancel($ticket)
    {

        $ticket = Ticket::find($ticket);
        if ($ticket != null) {
            $data['error'] = false;
            $data['ticket'] = $ticket;
            $data['deduction'] = $this->refundDetection($ticket);
            $ticket->seats()->delete();
            $ticket->status = 0;
            $ticket->save();
            $ticket->delete();
        } else
            $data = array('error' => 1, 'msg' => 'Ticket Not found');

        return response($data);
    }


    // calculate refund amount on cancel
    private function refundDetection($ticket)
    {
        $depart_time = strtotime($ticket->booking_for);
        $current_time = strtotime(date('Y-m-d H:m:i'));
        $diff_in_minutes = round(($depart_time - $current_time) / 60);

        $amount = $ticket->total_fare - $ticket->discount;

        if ($depart_time > $current_time && $diff_in_minutes >= 20) {
            if ($diff_in_minutes >= 60) {
                // 25% deduction
                $per = 25;
                $deduction = round($amount * .25);
            } else if ($diff_in_minutes >= 20) {
                // 40% deduction
                $per = 40;
                $deduction = round($amount * .4);
            }

        } else {
            // 50% deduction
            $per = 50;
            $deduction = round($amount * .5);
        }

        return $deduction;
    }

    // Cancel all tickets related to a schedule and date
    public function cancelAll(Request $req)
    {
        $schedule = $req->schedule;
        $bookingdate = $req->bookingdate;

        $tickets = Ticket::where('schedule_id', $schedule)->whereDate('booking_for', $bookingdate);
        $seats = TicketSeat::whereHas('ticket', function ($query) use ($schedule, $bookingdate) {
            return $query->where('schedule_id', $schedule)->whereDate('booking_for', $bookingdate);
        });

        $seats->delete();
        $tickets->delete();

        return response(array('msg' => 'All tickets deleted successfully.'));
    }

    public function booklist(Request $req)
    {
        $data['tickets'] = Ticket::where([['schedule_id', $req->schedule], ['paid', 0]])->whereDate('booking_for', $req->bookingdate)->get();
        $data['title'] = 'Ticket Booking List';
        return view('admin.ticket.list', $data);
    }

    public function issuelist(Request $req)
    {
        $data['tickets'] = Ticket::where([['schedule_id', $req->schedule], ['paid', 1]])->whereDate('booking_for', $req->bookingdate)->get();
        $data['title'] = 'Ticket Issue List';
        return view('admin.ticket.list', $data);
    }

    public function issueByID($id, Request $request)
    {
        $ticket = Ticket::find($id);
        if ($ticket == null) {
            return response(array('error' => 1, 'msg' => 'Ticket not found'));
        } else if ($ticket->paid == 1) {
            return response(array('error' => 1, 'msg' => 'Ticket already purchesed'));
        } else {
            $ticket->paid = 1;
            $ticket->save();
            return response(array('error' => 0, 'ticket' => $ticket));
        }
    }
}
