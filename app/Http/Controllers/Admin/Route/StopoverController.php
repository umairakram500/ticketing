<?php

namespace App\Http\Controllers\Admin\Route;

use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Route\Route;
use App\Models\Route\Stop;
use App\Models\Route\Stopover;
use Illuminate\Support\Facades\Session;

class StopoverController extends Controller
{
    use CommenFunctions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Route $route)
    {
        //dd($data);
        $data['route'] = $route;
        $data['stopovers'] =$route->stopovers;
        //$data['stop_keys'] = array_keys($data['stops']);
        //dd($data);
        return view('admin.route.stopover.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Route $route)
    {
        $data['route'] = $route;
        $data['stops'] = $this->toSelect($route->stops()->options());
        $data['stop_keys'] = array_keys($data['stops']);
        return view('admin.route.stopover.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Route $route, Request $request)
    {
        //dd($request->all());
        $stopovers = array();
        /*foreach($request->stops as $k => $stop){
            if(isset($stop['id'])){
                $stopovers[$k] = Stopover::find($stop['id']);
                $stopovers[$k]->fare = $stop['fare'];
                $stopovers[$k]->kms = $stop['kms'];
                $stopovers[$k]->travel_time = $stop['travel_time'];
            } else {
                $stopovers[$k] = new Stopover($stop);
            }
        }*/

        //$save = $route->stopovers()->saveMany($stopovers);
        //dd($save);
        Session::flush('flash_success', 'Stopover save successfully.');
        return redirect()->route('admin.route.edit', $route->id);
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
