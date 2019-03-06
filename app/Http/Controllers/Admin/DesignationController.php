<?php

namespace App\Http\Controllers\Admin;

use App\Models\Designation;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations = Designation::All();

        return view('admin.designation.index', ['designations' => $designations]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.designation.create");
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
            'title' => 'required|max:191|unique:designations,title',
            'code' => 'required|max:191|unique:designations,code',
            'status' => 'boolean',
        ]);
        $designation = new Designation();
        $designation->title = $request->title;
        $designation->code = $request->code;
        $designation->status = $request->status ? 1 : 0;

        if($designation->save()){
            //Session::flash('flash_success', 'Designation added successfully');
            return redirect()->route('admin.designation.index')->with('flash_success', 'Designation added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Designation $designation)
    {
        return view("admin.designation.show", $designation);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Designation $designation)
    {
        //$designation = Designation::find($id);
        return view("admin.designation.edit", ['designation' => $designation]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designation $designation)
    {
        $request->validate([
            'title' => 'required|max:191|unique:designations,title,'.$designation->id,
            'code' => 'required|max:191',
            'status' => 'boolean',
        ]);
        //$designation = new Designation();
        $designation->title = $request->title;
        $designation->code = $request->code;
        $designation->status = $request->status ? 1 : 0;

        if($designation->save()){
            //Session::flash('flash_success', 'Designation updated successfully');
            return redirect()->route('admin.designation.index')->with('flash_success', 'Designation updated successfully');
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
        $designation = Designation::find($id);

        if($designation->exists()){
            $return = $designation->delete();
        } else {
            $return = array('error'=>ture, 'msg'=> 'Recode not found.');
        }
        return response($return);
    }

    /*
     * change the Status of resource to active/deactive
     *
     * @param  \Illuminate\Http\Request  $request
     * @param int $id
     * @return response JSON
     * */
    public function status(Designation $designation)
    {
        //return response($designation->getRelations());
        if($designation->exists())
        {
            $designation->status = !$designation->status;
            $designation->save();
            return response(array('status' => $designation->status, 'error' => false, 'msg' => 'Designation Successfully '.($designation->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Designation not found.'));
        }

    }
}
