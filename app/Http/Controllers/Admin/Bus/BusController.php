<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Models\Bus\LuxuryType;
use App\Models\Bus\BusType;
use App\Models\Staff\Staff;
use App\Models\Bus\Bus;
use App\Models\Route\Route;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Terminal;
use Auth;

class BusController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $where = array();
        if(!Auth::user()->isadmin){
            $where['terminal_id'] = Auth::user()->terminal_id;
        }
        $list = Bus::where($where)->get();
        return view('admin.bus.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['routes'] = $this->toSelect(Route::Options());
        $data['terminals'] = $this->toSelect(Terminal::Options());
        $data['luxury_types'] = $this->toSelect(LuxuryType::Options());
        $data['bus_types'] = $this->toSelect(BusType::Options());
        $data['drivers'] = $this->toSelect(Staff::DriverOptions(), 'name');
        $data['conductors'] = $this->toSelect(Staff::ConductorOptions(), 'name');

        return view("admin.bus.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'route_id' => 'nullable|integer|exists:routes,id',
            'driver_id' => 'nullable|integer|exists:staff,id',
            'conductor_id' => 'nullable|integer|different:driver_id|exists:staff,id',
            'bus_type_id' => 'required|integer|exists:bus_types,id',
            'luxury_type_id' => 'required|integer|exists:luxury_types,id',
            'number' => 'string',
            'seats' => 'required|integer',
            'status' => 'boolean',
        ]);
        $bus = new Bus();
        $bus->title = $request->title;
        $bus->route_id = $request->route_id;
        $bus->driver_id = $request->driver_id;
        $bus->conductor_id = $request->conductor_id;
        $bus->number = $request->number;
        $bus->seats = $request->seats;
        $bus->foldings = $request->foldings;
        $bus->standees = $request->standees;
        $bus->status = $request->status ? 1 : 0;
        $bus->bus_type_id = $request->bus_type_id;
        $bus->refcode  = $request->refcode;
        $bus->luxury_type_id = $request->luxury_type_id;

        if($bus->save()){
            Session::flash('flash_success', 'Bus added successfully');
            return redirect()->route('admin.bus.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Bus $bus)
    {
        return view("admin.bus.show", $bus);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Bus $bus)
    {
        $data['bus'] = $bus;
        $data['routes'] = $this->toSelect(Route::Options());
        $data['terminals'] = $this->toSelect(Terminal::Options());
        $data['luxury_types'] = $this->toSelect(LuxuryType::Options());
        $data['bus_types'] = $this->toSelect(BusType::Options());
        $data['drivers'] = $this->toSelect(Staff::DriverOptions(), 'name');
        $data['conductors'] = $this->toSelect(Staff::ConductorOptions(), 'name');

        return view("admin.bus.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Bus $bus)
    {
        $request->validate([
            'title' => 'required|string|max:191',
            'route_id' => 'nullable|integer|exists:routes,id',
            'driver_id' => 'nullable|integer|exists:staff,id',
            'conductor_id' => 'nullable|integer|different:driver_id|exists:staff,id',
            'bus_type_id' => 'required|integer|exists:luxury_types,id',
            'number' => 'string',
            'seats' => 'required|integer',
            'status' => 'boolean',
            'luxury_type_id' => 'required|integer|exists:luxury_types,id',
        ]);

        $bus->title = $request->title;
        $bus->route_id = $request->route_id;
        $bus->driver_id = $request->driver_id;
        $bus->conductor_id = $request->conductor_id;
        $bus->number = $request->number;
        $bus->seats = $request->seats;
        $bus->status = $request->status ? 1 : 0;
        $bus->refcode  = $request->refcode;
        $bus->bus_type_id = $request->bus_type_id;
        $bus->luxury_type_id = $request->luxury_type_id;

        if($bus->save()){
            Session::flash('flash_success', 'Bus updated successfully');
            return redirect()->route('admin.bus.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Bus $bus)
    {
        //$bus = Bus::find($id);
        $error = true;
        $message = 'Bus not found.';
        if($bus->exists()){
            if($bus->delete()){
                $error = false;
                $message = 'Bus Deleted successfully.';
            } else {
                $message = 'Bus Delete error. Try later!';
            }
        } else {
            $error = true;

        }
        return response(['msg' => $message, 'error' => $error]);
    }

    /*
     * change the Status of resource to active/deactive
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     * */
    public function status(Request $request, Bus $bus)
    {
        $response = array('error' => true, 'msg' => 'Bus not found.');
        if($bus->exists())
        {
            $bus->status = !$bus->status;
            $bus->save();
            $response = array(
                'status' => $bus->status,
                'error' => false,
                'msg' => 'Bus Successfully '.($bus->status?"Activated":"Deactivated")
            );
        }

        return response($response);


    }
}
