<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Staff\StaffType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class StaffTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = StaffType::All();
        return view('admin.staff.type.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.staff.type.create");
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
            'title' => 'required|max:255|unique:staff_types,title',
            'status' => 'boolean'
        ]);
        $stafftype = new StaffType();
        $stafftype->title = $request->title;
        $stafftype->status = $request->status ? 1 : 0;

        if($stafftype->save()){
            Session::flash('flash_success', 'Staff Type added successfully');
            return redirect()->route('admin.staff.stafftype.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(StaffType $stafftype)
    {
        return view("admin.staff.type.show", $stafftype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(StaffType $stafftype)
    {
       // dd($stafftype);
        return view("admin.staff.type.edit", ['stafftype' => $stafftype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StaffType $stafftype)
    {
        $request->validate([
            'title' => 'required|max:255|unique:staff_types,title',
            'status' => 'boolean',
            'remarks' => 'string|nullable',
        ]);
        $stafftype->title = $request->title;
        $stafftype->status = $request->status ? 1 : 0;

        if($stafftype->save()){
            Session::flash('flash_success', 'Staff Type updated successfully');
            return redirect()->route('admin.staff.stafftype.index');
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
        $stafftype = StaffType::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($stafftype->exists()){
            if($stafftype->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'Staff Type Delete error. Try later!';
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
    public function status(StaffType $stafftype)
    {
        //dd($stafftype);
        if($stafftype->exists())
        {
            $stafftype->status = !$stafftype->status;
            $stafftype->save();
            return response(array('status' => $stafftype->status, 'error' => false, 'msg' => 'Staff Type Successfully '.($stafftype->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Luxury Type not found.'));
        }

    }
}
