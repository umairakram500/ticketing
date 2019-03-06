<?php

namespace App\Http\Controllers\Admin\Staff;

use App\Models\Staff\Staff;
use App\Models\Staff\StaffType;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class StaffController extends Controller
{
    use CommenFunctions;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Staff::All();

        return view('admin.staff.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $staff_types = $this->toSelect(StaffType::Options());
        return view("admin.staff.create", ['staff_types' => $staff_types]);
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
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'staff_type_id' => 'required|integer|exists:staff_types,id',
            'phone' => 'string|nullable',
            'address' => 'string|nullable',
            'cnic' => 'required',
            'cnic_expiry' => 'date|required',
            'licences' => 'string|nullable',
            'licences_expiry' => 'required_with:licences|date|nullable',
        ]);
        $staff = new Staff();
        $staff->name = $request->name;
        $staff->staff_type_id = $request->staff_type_id;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->status = $request->status ? 1 : 0;
        $staff->cnic = $request->cnic;
        $staff->cnic_expiry = $request->cnic_expiry;
        $staff->licences = $request->licences;
        $staff->licences_expiry = $request->licences_expiry;

        if($staff->save()){
            Session::flash('flash_success', 'Staff added successfully');
            return redirect()->route('admin.staff.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Staff $staff)
    {
        return view("admin.staff.show", $staff);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Staff $staff)
    {
        $data['staff'] = $staff;
        $data['staff_types'] = $this->toSelect(StaffType::Options());

        return view("admin.staff.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staff $staff)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'boolean',
            'staff_type_id' => 'required|integer|exists:staff_types,id',
            'phone' => 'string|nullable',
            'address' => 'string|nullable'
        ]);

        $staff->name = $request->name;
        $staff->staff_type_id = $request->staff_type_id;
        $staff->phone = $request->phone;
        $staff->address = $request->address;
        $staff->status = $request->status ? 1 : 0;

        if($staff->save()){
            Session::flash('flash_success', 'Staff updated successfully');
            return redirect()->route('admin.staff.index');
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
        $staff = Staff::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($staff->exists()){
            if($staff->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'Staff Delete error. Try later!';
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
    public function status(Request $request, Staff $staff)
    {
        if($staff->exists())
        {
            $staff->status = !$staff->status;
            $staff->save();
            return response(array('status' => $staff->status, 'error' => false, 'msg' => 'Staff Successfully '.($staff->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Staff not found.'));
        }

    }
}
