<?php

namespace App\Http\Controllers\Api;

use App\Models\Terminal;
use App\Models\Ticket\Ticket;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TicketController extends Controller
{
    public function store(Request $req)
    {
        //return response($req->all());

        $ticket = new Ticket();

        $ticket->route_id = $req->route_id;
        $ticket->schedule_id = $req->schedule_id;
        $ticket->from_stop = $req->from_stop;
        $ticket->to_stop = $req->to_stop;
        $ticket->total_fare = $req->fare;
        $ticket->total_seats = $req->psgs;
        $ticket->from_city_id = Terminal::find($req->from_stop)->city_id;
        $ticket->to_city_id = Terminal::find($req->to_stop)->city_id;
        $ticket->btype_id = 6;
        $ticket->booking_for = Date('Y-m-d');

        $ticket->save();

        return response($ticket);

    }
}
