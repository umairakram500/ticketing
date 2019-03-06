<?php

namespace App\Http\Controllers\Admin\Cargo;

use App\Models\Cargo\ShipmentStatus;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ShipmentStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = ShipmentStatus::All();
        //dd($list);
        return view('admin.cargo.shipment.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cargo.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'boolean'
        ]);
        if($request->id > 0)
            $shipment = ShipmentStatus::find($request->id);
        else
            $shipment = new ShipmentStatus();
        $shipment->title = $request->title;
        //$shipment->status = $request->status ? 1 : 0;

        if($shipment->save()){
            Session::flash('flash_success', 'ShipmentStatus '.($request->id?'added':'updated').' successfully');
            return redirect()->route('admin.cargo.shipment.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ShipmentStatus $shipment)
    {
        return view("admin.cargo.category.show", $shipment);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ShipmentStatus $shipment)
    {
        //$shipment->url = route(['admin.cargo.shipment.update', $shipment->id]);
        return response($shipment);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ShipmentStatus $shipment)
    {
        $request->validate([
            'title' => 'required|max:255',
            'status' => 'boolean'
        ]);
        $shipment->title = $request->title;
        //$shipment->status = $request->status ? 1 : 0;

        if($shipment->save()){
            Session::flash('flash_success', 'ShipmentStatus updated successfully');
            return redirect()->route('admin.cargo.shipment.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $shipment = ShipmentStatus::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($shipment->exists()){
            if($shipment->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'ShipmentStatus Delete error. Try later!';
            }
        } else {
            $error = true;

        }
        return response(['msg' => $message, 'error' => $error]);
    }

    /*
     * change the Status of resource to active/deactive
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     * */
    public function status(ShipmentStatus $shipment)
    {
        if($shipment->exists())
        {
            $shipment->status = !$shipment->status;
            $shipment->save();
            return response(array('status' => $shipment->status, 'error' => false, 'msg' => 'ShipmentStatus Successfully '.($shipment->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'ShipmentStatus not found.'));
        }

    }
}
