<?php

namespace App\Http\Controllers\Front;

use App\Models\Staff\Staff;
use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DoSearch;
use App\Models\City;
use NoCaptcha;

class HomeController extends Controller
{
    public function index()
    {
    	$allfrom = City::where(['status' => 1])->orderBy('name')->get();

    	return view('front.home');
    }

    public function genrateRoute()
    {
        $routes = array();
        $cities = City::All();
        foreach($cities as $key => $city)
        {
            //dd($city->terminal[0]->id);
            foreach($cities as $k => $c)
            {
                if($k != $key)
                {
                    $routes[] = array(
                        'title' => $city->name.' - '.$c->name,
                        'from_city_id' => $city->id,
                        'from_terminal_id' => $city->terminal[0]->id,
                        'to_city_id' => $c->id,
                        'to_terminal_id' => $c->terminal[0]->id,
                        'fare' => 550,
                        'travel_time' => '0:0',
                        'user_id' => 1,
                        'company_id' => 1
                    );
                }
            }
        }

        //Route::insert($routes);
        dd($routes);
    }

    public function addBuses()
    {
        $routes = array();
        $cities = Bus::All();
        foreach($cities as $key => $city)
        {
            //dd($city->terminal[0]->id);
            foreach($cities as $k => $c)
            {
                if($k != $key)
                {
                    $routes[] = array(
                        'title' => $city->name.' - '.$c->name,
                        'from_city_id' => $city->id,
                        'from_terminal_id' => $city->terminal[0]->id,
                        'to_city_id' => $c->id,
                        'to_terminal_id' => $c->terminal[0]->id,
                        'fare' => 550,
                        'travel_time' => '0:0',
                        'user_id' => 1,
                        'company_id' => 1
                    );
                }
            }
        }

        //Route::insert($routes);
        dd($routes);
    }




}
