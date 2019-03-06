<?php

namespace App\Http\Controllers\Admin;

use App\Models\Department;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $departments = Department::All();

        return view('admin.department.index', ['departments' => $departments]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.department.create");
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
            'title' => 'required|max:191|unique:departments,title',
            'code' => 'required|max:191|unique:departments,code',
            'status' => 'boolean',
        ]);
        $department = new Department();
        $department->title = $request->title;
        $department->code = $request->code;
        $department->status = $request->status ? 1 : 0;

        if($department->save()){
            //Session::flash('flash_success', 'Department added successfully');
            return redirect()->route('admin.department.index')->with('flash_success', 'Department added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        return view("admin.department.show", $department);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Department $department)
    {
        //$department = Department::find($id);
        return view("admin.department.edit", ['department' => $department]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'title' => 'required|max:191|unique:departments,title,'.$department->id,
            'code' => 'required|max:191',
            'status' => 'boolean',
        ]);
        //$department = new Department();
        $department->title = $request->title;
        $department->code = $request->code;
        $department->status = $request->status ? 1 : 0;

        if($department->save()){
            //Session::flash('flash_success', 'Department updated successfully');
            return redirect()->route('admin.department.index')->with('flash_success', 'Department updated successfully');
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
        $department = Department::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($department->exists()){
            $error = false;
            $message = $department->delete();
            /*if($department->delete()){
                $error = false;
                $message = 'Department Deleted successfully.';
            } else {
                $message = 'Department Delete error. Try later!';
            }*/
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
    public function status(Department $department)
    {
        //return response($department->getRelations());
        if($department->exists())
        {
            $department->status = !$department->status;
            $department->save();
            return response(array('status' => $department->status, 'error' => false, 'msg' => 'Department Successfully '.($department->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Department not found.'));
        }

    }
}
