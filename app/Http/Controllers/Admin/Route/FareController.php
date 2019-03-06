<?php

namespace App\Http\Controllers\Admin\Route;

use App\Models\Bus\LuxuryType;
use App\Models\Route\Fare;
use App\Models\Route\Route;
use App\Models\Terminal;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FareController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $routes = Route::where('status', 1)->get();
        return view('admin.fares.index', compact('routes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
    public function edit(Route $route)
    {
        $ids = array_column($route->stops->toArray(), 'terminal_id');
        $fares = Fare::Fares()->where('route_id', $route->id)->get()->toArray();
        $data['combiations'] = $this->getCombinations($ids);
        $data['terminals'] = Terminal::whereIn('id',$ids)->selection();
        $data['bus_types'] = LuxuryType::Selection();
        $data['route'] = $route;
        $data['fares'] = $this->toSelect($fares, 'fare', 'fare_id');
        $data['kms'] = $this->toSelect($fares, 'kms', 'fare_id');
        //dd($data);
        return view('admin.fares.edit', $data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $route)
    {
        //dd($request->all());
        Fare::where('route_id', $route)->delete();

        $fares = array();

        if(isset($request->stops) && count($request->stops)){
            foreach($request->stops as $luxid => $stops){
                if(is_array($stops) && count($stops)){
                    foreach($stops as $stop){
                        if($stop['fare'] > 0){
                            $fares[] = array(
                                'route_id' => $route,
                                'luxury_id' => $luxid,
                                'from_terminal_id' => $stop['from'],
                                'to_terminal_id' => $stop['to'],
                                'kms' => $stop['kms'],
                                'fare' => $stop['fare'],
                            );
                        }
                    }
                }
            }
        }
        //dd($fares);
        if(count($fares)){
            Fare::insert($fares);
        }
        return redirect()->route('admin.fares.index')->with('flash_success', 'Fares updated successfully');
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
