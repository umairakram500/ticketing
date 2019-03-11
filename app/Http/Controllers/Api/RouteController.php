<?php

namespace App\Http\Controllers\Api;

use App\Models\Route\Route;
use App\Models\Route\Stop;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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

        // dd($data);

        return response($data);
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
}
