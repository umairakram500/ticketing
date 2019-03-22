<?php

namespace App\Http\Controllers\Admin\Route;

use App\Http\Requests\RouteRequest;
use App\Models\Bus\LuxuryType;
use App\Models\City;
use App\Models\Route\Fare;
use App\Models\Route\Route;
use App\Models\Route\RouteDiesel;
use App\Models\Route\Stop;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use App\Models\Terminal;
use Auth;

class RouteController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*if(!Auth::user()->isadmin){
            $list = Route::where('from_terminal_id', Auth::user()->terminal_id)->get();
        } else*/
            $list = Route::All();

        return view('admin.route.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['luxuries'] = $this->toSelect(LuxuryType::Options());

        return view("admin.route.create", $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RouteRequest $request)
    {
        $route = new Route();
        $route->title = $request->title;
        $route->from_city_id = $request->from_city_id;
        $route->to_city_id = $request->to_city_id;
        $route->from_terminal_id = $request->from_terminal_id;
        $route->to_terminal_id = $request->to_terminal_id;
        $route->fare = $request->fare;
        $route->status = $request->status;
        $route->kms = $request->kms;
        //$route->diesel = $request->diesel;

        $stops = $request->stops;

        if(current($stops) !== $request->from_terminal_id){
            array_unshift($stops, $request->from_terminal_id);
        }
        if(end($stops) !== $request->to_terminal_id){
            $stops[] =  $request->to_terminal_id;
        }


        if($route->save()){
            $this->saveStops($request->stops, $route, $route->from_terminal_id, $route->to_terminal_id);
            //$this->saveFares($request->fares, $route);
            $this->saveDiesel($request->diesels, $route);
            Session::flash('flash_success', 'Route addedd successfully.');
            return redirect()->route('admin.route.index');
        } else {
            Session::flash('flash_error', 'Went wrong! Try later');
            return redirect()->back()->withInput();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        return view("admin.route.show", $route);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //dd(RouteDiesel::All());
        $data['route'] = $route;
        $data['luxuries'] = $this->toSelect(LuxuryType::Options());
        $data['fares'] = $this->toSelect(Fare::where('route_id', $route->id)->Options(), 'fare');
        $data['diesel'] = $route->diesels->pluck('litres', 'bustype_id')->toArray();

        return view("admin.route.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RouteRequest $request, Route $route)
    {
        $this->saveDiesel($route, $request->diesel);
        $route->title = $request->title;
        $route->from_city_id = $request->from_city_id;
        $route->to_city_id = $request->to_city_id;
        $route->from_terminal_id = $request->from_terminal_id;
        $route->to_terminal_id = $request->to_terminal_id;
        $route->fare = $request->fare;
        $route->status = $request->status;
        $route->kms = $request->kms;
        //$route->diesel = $request->diesel;
        //$route->travel_time = $request->hrs.":".$request->mins;
        //$route->stations = json_encode($request->stations) ;
        //$route->kms = $request->kms;
        //$this->saveStops($request->stops, $route, $route->from_terminal_id, $route->to_terminal_id);
        if($route->save()){
            $this->saveStops($request->stops, $route, $route->from_terminal_id, $route->to_terminal_id);
            $this->saveDiesel($request->diesels, $route);
            Session::flash('flash_success', 'Route updated successfully');
            return redirect()->route('admin.route.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        //$route = Route::find($id);
        $error = true;
        $message = 'Route not found.';
        if($route->exists()){
            if($route->delete()){
                $error = false;
                $message = 'Route Delete successfully.';
            } else {
                $message = 'Route Delete error. Try later!';
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
    public function status(Request $request, Route $route)
    {
        if($route->exists())
        {
            $route->status = !$route->status;
            $route->save();
            return response(array('status' => $route->status, 'error' => false, 'msg' => 'Route Successfully '.($route->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Route not found.'));
        }

    }


    private function saveStops($stops, $route, $from, $to)
    {
        $stops = array_diff($stops, [$from, $to]);
        array_unshift($stops, $from);
        array_push($stops, $to);
        Stop::where('route_id', $route->id)->whereNotIn('terminal_id', $stops)->delete();
        if(is_array($stops) && count($stops))
        {
            foreach($stops as $k => $stop){
                Stop::updateOrCreate(['route_id' => $route->id, 'terminal_id' => $stop], ['sort_order'=>($k+1)]);
            }
        }

    }

    private function saveFares($fares, $route)
    {

        if(is_array($fares) && count($fares)) {
            foreach ($fares as $luxID => $amt) {
                $fare = Fare::updateOrCreate(
                    ['route_id' => $route->id, 'luxury_id' => $luxID],
                    ['fare' => $amt]
                );
            }
        }
    }

    private function saveDiesel($route, $diesels)
    {
        if(is_array($diesels) && count($diesels)) {
            foreach ($diesels as $bustype => $litres) {
                RouteDiesel::updateOrCreate(
                    ['route_id' => $route->id, 'bustype_id' => $bustype],
                    ['litres' => $litres]
                );
            }
        }
    }

    public function getStops(Route $route)
    {

        $stops = Stop::select('terminal_id')->with('terminal:id,title')->where('route_id', $route->id)->get()->toArray();
        $fares = $route->fares->toArray();
        $data['stops'] = array();
        $data['fares'] = array();
        $data['from'] = $route->from_terminal_id;
        $data['to'] = $route->to_terminal_id;
        if($stops !== null){
            $data['stops'] = array_column($stops, 'terminal');
        }

        if(count($fares)){
            foreach($fares as $fare){
                $data['fares'][$fare['luxury_id']][] = $fare;
            }
        }

        return response($data);
    }



}
