<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = City::All();

        return view('admin.city.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.city.create");
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
            'name' => 'required|max:255|unique:cities,name',
            'status' => 'boolean',
            'remarks' => 'string|nullable',
        ]);
        $city = new City();
        $city->name = $request->name;
        $city->status = $request->status ? 1 : 0;
        $city->remarks = $request->remarks;

        if($city->save()){
            Session::flash('flash_success', 'City added successfully');
            return redirect()->route('admin.city.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(City $city)
    {
        return view("admin.city.show", $city);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(City $city)
    {
        //$city = City::find($id);
        return view("admin.city.edit", ['city' => $city]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, City $city)
    {
        $request->validate([
            'name' => 'required|max:255|unique:cities,name',
            'status' => 'boolean',
            'remarks' => 'string|nullable',
        ]);
        $city->name = $request->name;
        $city->status = $request->status ? 1 : 0;
        $city->remarks = $request->remarks;

        if($city->save()){
            Session::flash('flash_success', 'City updated successfully');
            return redirect()->route('admin.city.index');
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
        $city = City::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($city->exists()){
            if($city->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'City Delete error. Try later!';
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
    public function status(City $city)
    {
        //return response($city->getRelations());
        if($city->exists())
        {
            $city->status = !$city->status;
            $city->save();
            return response(array('status' => $city->status, 'error' => false, 'msg' => 'City Successfully '.($city->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'City not found.'));
        }

    }
}
