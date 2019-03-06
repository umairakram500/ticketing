<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boarding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CashierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $data = array('user_id' => null, 'date'=>date('Y-m-d'));

        if(isset($req->user_id) && $req->user_id > 0){
            $data['user_id'] = $req->user_id;
            $data['date'] = $req->date;
            $data['boardings'] = Boarding::where('user_id', $req->user_id)
                                    ->whereDate('created_at', $req->date)->get();
        }

        return view('admin.cashier.create', $data);
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
    public function show(Request $req)
    {
        $data = array();
        if(isset($req->user_id) && $req->user_id > 0){
            $data['user_id'] = Auth::user($req->user_id);
            $data['date'] = $req->date;
            $data['boardings'] = Boarding::where('user_id', $req->user_id)
                ->whereDate('created_at', $req->date)->get();
        }
        return view('admin.cashier.print', $data);
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
