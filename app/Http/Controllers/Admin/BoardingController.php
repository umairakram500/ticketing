<?php

namespace App\Http\Controllers\Admin;

use App\Models\Route\Stop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use App\Traits\CommenFunctions;
use App\Models\City;
use App\Models\Terminal;
use App\Models\ExpenseType;
use App\Models\Staff\Staff;
use App\Models\Bus\Bus;
use App\Models\Schedule;
use App\Models\Route\Route;
use App\Models\Ticket\Ticket;
use App\Models\Boarding;
use App\Models\BoardingExpense;
use App\Models\ExpensetypeTerminal;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;

class BoardingController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Boarding::All();
        return view('admin.board.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $data['terminals'] = array();
        $data['schedules'] = array();
        $data['route'] = isset($req->route) ? $req->route : null;
        $data['schedule'] = isset($req->schedule) ? $req->schedule : null;
        $data['stops'] = array();
        $data['booked_seats'] = 0;
        $data['extra_seats'] = 0;
        $data['total_seats'] = 0;

        $boodingdate = isset($req->bookingdate) ? date('Y-m-d', strtotime($req->bookingdate)) : date('Y-m-d');

        if(isset($req->route))
        {
            $route = Route::find($req->route);
            $data['schedules'] = $route->schedulesList();
            $data['stops'] = $route->StopsList();
        }

        if(isset($req->schedule))
        {
            $schedule = Schedule::find($req->schedule);
            $data['booked_seats'] = $schedule->tickets()->SeattypeSum($boodingdate, 1);
            $data['extra_seats'] = $schedule->tickets()->SeattypeSum($boodingdate, 0);
            $data['total_seats'] = $data['booked_seats'] + $data['extra_seats'];

            $tickets = $schedule->tickets()->where('paid', 1)->whereDate('booking_for',$boodingdate)->get();

            $data['total_fare'] = $tickets->sum('total_fare');
            $data['total_discount'] = $tickets->sum('discount');

        }


        // dd($data);


        return view('admin.board.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //dd($request->all());

        $boarding = new Boarding();

        $boarding->route_id = $request->route_id;
        $boarding->schedule_id = $request->schedule_id;
        //$boarding->from_city = $request->from_city;
        //$boarding->to_city = $request->to_city;
        $boarding->from_terminal = Auth::user()->terminal_id;
        $boarding->to_terminal = $request->to_terminal;
        $boarding->driver_id = $request->driver_id;
        $boarding->conductor_id = $request->conductor_id;
        $boarding->bus_id = $request->bus_id;
        //$boarding->to_stop = $request->to_stop;

        $boarding->total_passenger = $request->total_psg;
        $boarding->total_fare = $request->total_fare;
        $boarding->total_exp = array_sum($request->exp);
        $boarding->total_discount = $request->total_discount;
        $boarding->netcash = $request->total_fare
                                - $request->total_discount
                                - array_sum($request->exp)
                                - $request->total_discount;
        //dd($boarding);
        $boarding->save();
        //$user_terminal_id = Auth::user()->terminal_id;
        foreach($request->exp as $expid => $expamt){
            // ExpensetypeTerminal::updateOrCreate(['terminal_id' => $user_terminal_id,'expensetype_id' => $expid], ['amount' => $expamt]);
            $boardingexpense = new BoardingExpense();
            $boardingexpense->boarding_id =  $boarding->id;
            $boardingexpense->expense_type_id =  $expid;
            $boardingexpense->amount =  $expamt;
            $boardingexpense->save();
        }
        Session::flash('flash_success', 'Boarding added successfully');
        return redirect()->route('admin.departure.show', $boarding->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $boarding = Boarding::find($id);
        $bookingdate = date('Y-m-d', strtotime($boarding->created_at));

        $data['boarding'] = $boarding;
        $data['explist'] = $boarding->expenses->pluck('amount', 'expense_type_id')->toArray();
        $data['ticketStops'] = $boarding->schedule->ticketStops($bookingdate)->get();
        //dd($data['ticketStops']);

        return view('admin.board.print', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Boarding $boarding)
    {
        $data['boarding'] = $boarding;
        //dd($data['boarding']); exit;
        //Select all routes titles
        $data['routes'] = Route::select('title');
        //Select all cities names
        $data['cities'] = City::select('name');
        //Select all terminals titles
        $data['terminals'] = Terminal::select('title');
        //Select all expense type where terminal deduct is true
        $data['exptype']= ExpenseType::all()->where('terminal_deduct',1);
  
        $user_terminal_id = Auth::user()->terminal_id;
        $terminal = Terminal::find($user_terminal_id);
        
        $abc = $terminal->expensetypes()->get();
        $xyz = BoardingExpense::where('boarding_id', $boarding->id)->get();
        $newval = array();
        foreach ($xyz as $key => $value) {
            $newval[] = $value->amount; 
        }
        $data['newval'] = $newval;
        $myvals = array();
        foreach($abc as $a => $b){
            $myvals[] = $b->pivot->amount;
            
        }
        $data['myvals'] = $myvals;
        $data['sum_myvals'] = array_sum($newval); 
        return view('admin.board.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Boarding $boarding)
    {
        $boarding->route_id = $request->route;
        $boarding->schedule_id = $request->schedule;
        $boarding->from_city = $request->from_city;
        $boarding->to_city = $request->to_city;
        $boarding->terminal_id = $request->terminal;
        $boarding->date = $request->date;
        $boarding->driver_id = $request->driver;
        $boarding->conductor_id = $request->conductor_hostess;
        $boarding->bus_id = $request->bus;

        $boarding->total_passenger = $request->pass_seat;
        $boarding->total_fare = $request->total_fare;
        $boarding->total_exp = $request->sum_myvals;
        $boarding->total_discount = $request->discount;
        $boarding->netcash = $request->net;
        
        $boarding->save();
        $user_terminal_id = Auth::user()->terminal_id;
        foreach($request->exp as $expid => $expamt){
            BoardingExpense::updateOrCreate(['boarding_id' => $boarding->id,'expense_type_id' => $expid], ['amount' => $expamt]);
        }
        Session::flash('flash_success', 'Boarding updated successfully');
        return redirect()->route('admin.boarding.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Boarding $boarding)
    {
               
                $error = true;
                $message = 'boarding not found.';
                if($boarding->exists()){
                    if($boarding->delete()){
                        $error = false;
                        $message = 'boarding Deleted successfully.';
                    } else {
                        $message = 'boarding Delete error. Try later!';
                    }
                } else {
                    $error = true;
        
                }
                return response(['msg' => $message, 'error' => $error]);
    }


    public function getInfo(Request $req, $id)
    {
        $boarding = Boarding::where('id',$id)->whereNull('voucher_id')->with(['route:id,title', 'terminal:id,title'])->get()->first();
        //dd($boarding->toArray());

        if($boarding !== null){
            if($boarding->bus_id == $req->busid){
                $expenses = $boarding->expenses->pluck('amount', 'expense_type_id')->toArray();
                $board = $boarding->toArray();
                $board['addeddate'] = date('m-d-Y', strtotime($boarding->created_at));
                $board['addedtime'] = date('h:i A', strtotime($boarding->created_at));
                $board['total'] = $boarding->total_fare - $boarding->total_discount;
                $return = array(
                    'error' => 0,
                    'boarding' => $board,
                    'expenses' => $expenses
                );
            } else {
                $return = array('error'=>1, 'message'=>'Voucher Not related to Selected Bus');
            }
        } else {
            $return = array('error'=>1, 'message'=>'Voucher not Found');
        }

        return response($return);
    }
}
