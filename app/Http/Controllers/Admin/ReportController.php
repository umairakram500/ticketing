<?php

namespace App\Http\Controllers\Admin;

use App\Models\Schedule;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ReportController extends Controller
{
    public function index()
    {
        //
    }

    public function schedules()
    {

        $schedules = Schedule::where('closed',1)->get();

        //dd($schedules);

        return view('admin.report.schedule', ['schedules' => $schedules]);
    }
}
