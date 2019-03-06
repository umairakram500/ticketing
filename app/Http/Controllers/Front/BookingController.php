<?php

namespace App\Http\Controllers\Front;

use App\Models\Schedule;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookingController extends Controller
{
    use CommenFunctions;

    public function index()
    {
    	echo 'booking';
    }

    public function schedules(Request $request)
    {

        $data['depts'] = $from = $request['depts'];
        $data['arrive'] = $to = $request['arrive'];
        $data['date'] = urldecode($request['date']);
        $date = date('Y-m-d', strtotime($data['date']));
        //dd($date);

        $data['schedules'] = Schedule::where('depart_time', 'like', $date.'%')->wherehas('route',
            function($q) use ($from, $to) {
                $q->where('from_city_id', $from)->where('to_city_id', $to);
            })->get();

        return view('front.booking.schedules', $data);
    }

    public function bookticket(Schedule $schedule)
    {
        $data['schedule'] = $schedule;
        $data['seats'] = $this->toSelect($schedule->seats->toArray(), 'gender', 'seat');
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

        return view('front.booking.bookticket', $data);
    }


}
