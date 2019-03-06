<?php

namespace App\Http\Controllers\front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Staff\Staff;

class AjaxController extends Controller
{
    public function GetArriv(Request $req)
    {
        //dd($req->all());
    	$getarrives = Route::select('to_city_id')->where(['status' => 1, 'from_city_id' => $req->deptid])
    	                                            ->groupBy('to_city_id')->get();
        //dd($getarrives);
    	return view('front.ajaxpages.main', ['arrivs' => $getarrives ]);
    }
}
