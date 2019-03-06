<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;

class PagesController extends Controller
{

    public function about()
    {

        return view('front.pages.about');
    }
	
	public function history()
    {

        return view('front.pages.history');
    }
	
	public function cities()
    {

        return view('front.pages.cities');
    }
	
	public function gallary()
    {

        return view('front.pages.gallary');
    }
	
	public function contact()
    {

        return view('front.pages.contact');
    }
	
	public function home()
    {

        return view('front.pages.home');
    }
}
