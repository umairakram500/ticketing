<?php

namespace App\Http\Controllers\Admin;

use App\Models\Bus\Bus;
use App\Models\ExpenseType;
use App\Models\Route\Fare;
use App\Models\Route\Stop;
use App\Models\ScheduleStop;
use App\Models\Staff\Staff;
use App\Models\Schedule;
use App\Models\Route\Route;
use App\Models\Ticket\Ticket;
use App\Traits\CommenFunctions;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ScheduleController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the Schedules.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schedules = Schedule::All();
        return view('admin.schedules.index', compact('schedules'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schedules.create');
    }

    public function getStops($route)
    {
        $stops = Stop::select('terminal_id')->with('terminal:id,title')->where('route_id', $route)->get()->toArray();

        $data = array();
        if($stops !== null){
            $data = array_column($stops, 'terminal');
        };

        return response($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->stops);
        $request->validate([
            'route_id' => 'required|integer|exists:routes,id',
            'luxury_type' => 'required|integer|exists:luxury_types,id',
            'type' => 'required|integer',
            'from_date' => 'date',
            'to_date' => 'date',
            'notes' => 'nullable|string',
            'city_id' => 'integer|exists:cities,id',
            'stops' => 'required|array',
            //'stops.*.depart' => 'required',
            //'stops.*.arrive' => 'required'
        ]);
        $schedule = new Schedule();
        $stops = $request->stops;
        $depart_time = current($stops);
        //$last_stop = end($stops);
        $arrival_time = end($stops);

        $schedule->route_id = $request->route_id;
        $schedule->luxury_type = $request->luxury_type;
        $schedule->type = $request->type;
        $schedule->from_date = isset($request->from_date) ? date('Y-m-d', strtotime($request->from_date)) : null;
        $schedule->to_date = isset($request->to_date) ? date('Y-m-d', strtotime($request->to_date)) : null;
        $schedule->notes = $request->notes;
        $schedule->city_id = $request->city_id;
        $schedule->reverse = $request->reverse ? 1 : 0;
        $schedule->depart_time = $depart_time['depart'];
        $schedule->arrival_time = $arrival_time['arrive'];
        //dd($schedule);

        if($schedule->save()){
            if(isset($request->stops)&& count($request->stops)){
                //dd($schedule);
                $this->saveStops($schedule, $request->stops);
            }
            return redirect()->route('admin.schedules.index')->with('flash_success', 'Schedule added successfully');
        }

    }

    public function saveStops($schedule, $stops)
    {
        if(is_array($stops) && count($stops)){
            foreach($stops as $id => $stop){
                $stopslist[] = array(
                    'terminal_id'=>$id,
                    'schedule_id'=>$schedule->id,
                    'route_id'=>$schedule->route_id,
                    'depart'=> $stop['depart'] != '' ? date('H:i:s', strtotime($stop['depart'])) : null,
                    'arrive'=> $stop['arrive'] != '' ? date('H:i:s', strtotime($stop['arrive'])) : null
                );
            }
            ScheduleStop::insert($stopslist);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Schedule $schedule)
    {
        $stops = $schedule->stops;
        $schedule_stops = array();
        foreach($stops as $k => $stop){
            // dd($stop->schedule_stops);
             $schedule_stops[$stop->terminal_id] = array( 'depart'=>$stop->depart, 'arrive' => $stop->arrive );
        }
        //dd($schedule_stops);
        return view('admin.schedules.edit', compact('schedule', 'schedule_stops'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Schedule $schedule)
    {
        $request->validate([
            'route_id' => 'required|integer|exists:routes,id',
            'luxury_type' => 'required|integer|exists:luxury_types,id',
            'type' => 'required|integer',
            'from_date' => 'date',
            'to_date' => 'date',
            'notes' => 'nullable|string',
            'city_id' => 'integer|exists:cities,id',
            'stops' => 'required|array',
            //'stops.*.depart' => 'required',
            //'stops.*.arrive' => 'required'
        ]);

        $stops = $request->stops;
        $depart_time = current($stops);
        $arrival_time = $stops[count($stops)-1];

        $schedule->route_id = $request->route_id;
        $schedule->luxury_type = $request->luxury_type;
        $schedule->type = $request->type;
        $schedule->from_date = isset($request->from_date) ? date('Y-m-d', strtotime($request->from_date)) : null;
        $schedule->to_date = isset($request->to_date) ? date('Y-m-d', strtotime($request->to_date)) : null;
        $schedule->notes = $request->notes;
        $schedule->city_id = $request->city_id;
        $schedule->reverse = $request->reverse ? 1 : 0;
        $schedule->depart_time = $depart_time['depart'];
        $schedule->arrival_time = $arrival_time['arrive'];

        // dd($schedule);

        if($schedule->save()){
            ScheduleStop::where('schedule_id', $schedule->id)->delete();

            if(isset($request->stops)&& count($request->stops)){
                $this->saveStops($schedule, $request->stops);
            }
            return redirect()->route('admin.schedules.index')->with('flash_success', 'Schedule updated successfully');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $schedule = Schedule::find($id);
        if($schedule->exists())
        {
            $schedule->stops()->delete();
            $del = $schedule->delete();
            if($del === true){
                return response(array( 'error' => true, 'msg' => 'Schedule deleted successfully' ));
            } else {
                return response(array( 'error' => false, 'msg' => 'Schedule delete error' ));
            }

        }
        else {
            return response(array('error' => true, 'msg' => 'City not found.'));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function bookTicket(Schedule $schedule)
    {
        $data['schedule'] = $schedule;
        $data['seats'] = $this->toSelect($schedule->seats->toArray(), 'gender', 'seat');
        $data['btypes'] = $this->toSelect($schedule->seats()->addSelect(['seat', 'tickets.btype_id'])->get()->toArray(), 'btype_id', 'seat');

        $cities = $schedule->route->station;
        $from = $schedule->route->from_city;
        $to = $schedule->route->to_city;
        $data['from_cities'][$from->id] = $from->name;
        if(count($cities)){
            foreach ($cities as $id => $name) {
                $data['from_cities'][$id] = $name;
            }
        }

        $cities[$to->id] = $to->name;
        $data['to_cities'] = $cities;
        $data['to_city'] = $to->id;
        $data['stops'] = $this->toSelect($schedule->route->stops()->options());

        $data['stopovers'] = $schedule->route->stopovers->toJson();
        //dd($data['stopovers']);

        return view('admin.schedule.bookTicket', $data);
    }

    /**
     * Display a listing of the Terminal Routes.
     *
     * @return \Illuminate\Http\Response
     */
    public function routes()
    {
        $list = Route::where('from_terminal_id', Auth::user()->terminal_id)->get();
        return view('admin.schedule.routes', ['list' => $list]);
    }

    /**
     * Display a listing of the Route Buses.
     *
     * @return \Illuminate\Http\Response
     */
    public function routeBuses($route)
    {
        $buses = Bus::where([
            //['terminal_id', Auth::user()->terminal_id],
            ['route_id', $route]
        ])->with('schedule')->withCount('schedule')->get();
        return view('admin.schedule.buses', ['buses' => $buses]);
    }

    /**
     * Display a listing of the not Scheduled buses.
     *
     * @return \Illuminate\Http\Response
     */
    public function buses()
    {
        //$noBuses = Bus::noSchedule('schedules')->OnUserTerminal()->get();
        $noBuses = Bus::whereDoesntHave('schedules', function($query){
                        $query->where('arrived', 0);
                    })->where('status', 1)->get();

        //dd($noBuses[0]);
        return view('admin.schedule.buses', ['buses' => $noBuses]);
    }

    /*
     * change the Status of resource to active/deactive
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     * */
    public function status($id)
    {

        $schedule = Schedule::find($id);
        //return response($schedule ? 1 : 0);
        if($schedule)
        {
            $schedule->status = !$schedule->status;
            $schedule->save();
            return response(array('status' => $schedule->status, 'error' => false, 'msg' => 'Schedule Successfully '.($schedule->status?"Activated":"Canceled") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Schedule not found.'));
        }

    }

    /*
     * change the Status of resource to Closed
     *
     * */
    public function close($id)
    {

        $schedule = Schedule::find($id);
        //return response($schedule ? 1 : 0);
        if($schedule)
        {
            $schedule->closed = 1;
            $schedule->save();
            return response(array('status' => 1, 'error' => false, 'msg' => 'Schedule Successfully Closed'));
        }
        else {
            return response(array('error' => true, 'msg' => 'Schedule not found.'));
        }

    }

    /*
     * change the departure of resource to true/false
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     * */
    public function departure($id)
    {

        $schedule = Schedule::find($id);
        //return response($schedule ? 1 : 0);
        if($schedule)
        {
            $schedule->departured = 1;
            //$schedule->vochered_at = Carbon::now();
            $schedule->save();
            return response(array('status' => $schedule->status, 'error' => false, 'msg' => 'Bus Successfully Departured. ' ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Bus not found.'));
        }

    }

    /*
     * change the arrive of resource to true/false
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     **/
    public function arrive($id)
    {
        $schedule = Schedule::find($id);
        //return response($schedule ? 1 : 0);
        if($schedule)
        {
            $schedule->arrived = 1;
            $schedule->arrived_at = date('Y-m-d H:i:s');
            $schedule->save();
            return response(array('status' => $schedule->status, 'error' => false, 'msg' => 'Bus Successfully Arrived' ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Schedule not found.'));
        }
    }

    /**
     * List of Schedules pending for Vouchers
     *
     * @return \Illuminate\Http\Response
     */
    public function voucherList()
    {
        $where['arrived'] = 1;
        $where['closed'] = 1;
        if(!Auth::user()->isadmin){
            $where['terminal_id'] = Auth::user()->terminal_id;
        }

        $data['vouchers'] = Schedule::where($where)->get();

        //dd($data);
        //$data['tickets'] = Ticket::where('voucher_no', '!=', '')->get();
        return view('admin.schedule.voucher_list', $data );
    }

    /**
     * Voucher add form
     *
     * @return \Illuminate\Http\Response
     */
    public function voucher(Schedule $schedule)
    {
        $schedule_id = $schedule->id;
        $data['schedule'] = $schedule;
        $data['expense_types'] = $this->toSelect(ExpenseType::Options());
        $expenseDepart = $schedule->expenseDepart->toArray();
        $data['expenseDepart'] =  $this->toSelect($expenseDepart, 'amount', 'expense_type_id');
        $data['expenseDepart_ids'] =  $this->toSelect($expenseDepart, 'id', 'expense_type_id');
        $expenseReturn = $schedule->expenseReturn->toArray();
        $data['expenseReturn'] =  $this->toSelect($expenseReturn, 'amount', 'expense_type_id');
        $data['expenseReturn_ids'] =  $this->toSelect($expenseReturn, 'id', 'expense_type_id');
        //dd(array_merge($data['expenses'], $data['expense_ids']));

        $cities = $schedule->route->station;
        $from = $schedule->route->from_city;
        $to = $schedule->route->to_city;
        $data['from_cities'][$from->id] = $from->name;
        if(count($cities)){
            foreach ($cities as $id => $name) {
                $data['from_cities'][$id] = $name;
            }
        }

        $cities[$to->id] = $to->name;
        $data['to_cities'] = $cities;

        return view('admin.schedule.voucher', $data );
    }

    /**
     * Save Voucher number
     *
     * @return \Illuminate\Http\Response
     */
    public function saveVoucherNumber(Schedule $schedule, Request $request)
    {
        $schedule->voucher_no = $request->voucher_no;
        $res = !$schedule->save();
        return response(['error' => $res, 'message' => 'Voucher Number '.($res?'Not':'').' Saved']);
    }

    /**
     * Save Voucher ticket
     *
     * @return \Illuminate\Http\Response
     */
    public function saveVoucherRow(Schedule $schedule, Request $request)
    {
        $request->validate([
            'ticket_no' => 'required|integer',
            'from_city_id' => 'required|integer|exists:cities,id',
            'to_city_id' => 'required|integer|exists:cities,id|different:from_city_id',
            'fare' => 'required|integer'
        ]);
        $ticket = new Ticket();
        $ticket->ticket_no = $request->ticket_no;
        //$ticket->remarks = $request->from.' => '.$request->to;
        $ticket->total_seats = $request->qty;
        $ticket->total_fare = $request->fare;
        $ticket->voucher_no = $schedule->voucher_no;
        $ticket->schedule_id = $schedule->id;
        $ticket->route_id = $schedule->route_id;
        $ticket->bus_id = $schedule->bus_id;
        $ticket->from_city_id = $schedule->route->from_city_id;
        $ticket->to_city_id = $schedule->route->to_city_id;
        $ticket->departure = $request->departure;
        $ticket->btype_id = 6;
        $res = $ticket->save();
        if( is_bool($res)){
            $error = !$res;
            $msg = "ticket ".(!$res?'not':'')." saved";
        } else {
            $error = true;
            $msg = $res->message;
        }

        return response(['error' => $error, 'message' => $msg]);
    }

    public function vprint(Schedule $schedule)
    {
        return dd($schedule);
    }

    public function getRouteFare($luxury, $route)
    {
        $fare = Fare::where([
            ['route_id', $route],
            ['luxury_id', $luxury]
        ])->get()->first();

        return $fare !== null ? $fare->fare : 0;
    }


}
