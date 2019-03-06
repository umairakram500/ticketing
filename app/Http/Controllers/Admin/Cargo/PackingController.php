<?php

namespace App\Http\Controllers\Admin\Cargo;

use App\Models\Cargo\PackingType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PackingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = PackingType::All();
        //dd($list);
        return view('admin.cargo.packing.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cargo.packing.create");
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
            $packing = PackingType::find($request->id);
        else
            $packing = new PackingType();
        //$packing = new PackingType();
        $packing->title = $request->title;
        //$packing->status = $request->status ? 1 : 0;

        if($packing->save()){
            Session::flash('flash_success', 'PackingType '.($request->id?'added':'updated').' successfully');
            return redirect()->route('admin.cargo.packing.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(PackingType $packing)
    {
        return view("admin.cargo.packing.show", $packing);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PackingType $packing)
    {
        //$packing = PackingType::find($id);
        return response($packing);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PackingType $packing)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'boolean'
        ]);
        $packing->name = $request->name;
        //$packing->status = $request->status ? 1 : 0;

        if($packing->save()){
            Session::flash('flash_success', 'PackingType updated successfully');
            return redirect()->route('admin.cargo.packing.index');
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
        $packing = PackingType::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($packing->exists()){
            if($packing->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'PackingType Delete error. Try later!';
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
    public function status(PackingType $packing)
    {
        if($packing->exists())
        {
            $packing->status = !$packing->status;
            $packing->save();
            return response(array('status' => $packing->status, 'error' => false, 'msg' => 'PackingType Successfully '.($packing->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'PackingType not found.'));
        }

    }
}
