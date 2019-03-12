<?php

namespace App\Http\Controllers\Api;

use App\Models\Route\Fare;
use App\Models\Route\Route;
use App\Models\Route\Stop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::select(['id', 'title'])->get();

        return response($routes);
    }

    public function info(Route $route)
    {
        $data['from'] = $route->from_terminal_id;
        $data['to'] = $route->to_terminal_id;

        $data['fares'] = $route->fares()
            ->select(['from_terminal_id as from_stop', 'to_terminal_id as to_stop', 'fare', 'luxury_id'])
            ->get()->toArray();

        $data['schedules'] = $route->schedules()->select(['id', 'depart_time as title', 'luxury_type as luxury_id'])->get()->toArray();

        $stops = $route->stops()->with('terminal')->get();
        foreach($stops as $stop)
            $data['stops'][] = ['id' => $stop->id, 'title' => $stop->terminal->title];

        return response($data);
    }

    public function getSchedules(Route $route)
    {
        return response($route->schedules()->select(['id', 'depart_time as title', 'luxury_type as luxury_id'])->get());
    }

    public function getStops(Route $route)
    {
        $stops = $route->stops()->with('terminal:id,title')->get()->toArray();
        $data['stops'] = [];
        if(count($stops)>0){
            foreach($stops as $stop){
                $data['stops'][] = $stop['terminal'];
            }
        }
        return response($data);
    }

    public function getFare(Route $route, Request $req)
    {
        $fare = Fare::select('fare')->where([
            ['route_id', $route->id],
            ['luxury_id', $req->luxury_id],
            ['from_terminal_id', $req->from_stop],
            ['to_terminal_id', $req->to_stop]
        ])->get('fare')->first();
        
        return response($fare != null ? $fare->fare : 0 );
    }


}
