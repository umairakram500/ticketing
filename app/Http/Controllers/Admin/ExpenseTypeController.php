<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\ExpenseTypeRequest;
use App\Models\ExpenseType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class ExpenseTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expense_types = ExpenseType::All();

        return view('admin.expense_type.index', ['expense_types' => $expense_types]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.expense_type.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ExpenseTypeRequest $request)
    {
        $expenseType = new ExpenseType();
        $expenseType->title = $request->title;
        $expenseType->amount = $request->amount;
        $expenseType->night_diff = $request->night_diff ? 1 : 0;
        $expenseType->nightfrom = $request->night_diff ? date('H:i:s', strtotime($request->nightfrom)) : null;
        $expenseType->nightto = $request->night_diff ? date('H:i:s', strtotime($request->nightto)) : null;
        $expenseType->nightamount = $request->nightamount;
        $expenseType->changeable = $request->changeable ? 1 : 0;
        $expenseType->terminal_deduct = $request->terminal_deduct ? 1 : 0;
        $expenseType->status = $request->status ? 1 : 0;
        $expenseType->refcode  = $request->refcode;

        if($expenseType->save()){
            Session::flash('flash_success', 'Expense Type added successfully');
            return redirect()->route('admin.expense_type.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(ExpenseType $expenseType)
    {
        return view("admin.expense_type.show", $expenseType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ExpenseType $expenseType)
    {
        //dd($expenseType);
        $expenseType->nightfrom = $expenseType->nightfrom ? date('h:i a', strtotime($expenseType->nightfrom)):'';
        $expenseType->nightto = $expenseType->nightto ? date('h:i a', strtotime($expenseType->nightto)) : '';
        //$expenseType = ExpenseType::find($id);
        return view("admin.expense_type.edit", ['expense_type' => $expenseType]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ExpenseTypeRequest $request, ExpenseType $expenseType)
    {
        $expenseType->title = $request->title;
        $expenseType->amount = $request->amount;
        $expenseType->night_diff = $request->night_diff ? 1 : 0;
        $expenseType->nightfrom = $request->night_diff ? date('H:i:s', strtotime($request->nightfrom)) : null;
        $expenseType->nightto = $request->night_diff ? date('H:i:s', strtotime($request->nightto)) : null;
        $expenseType->nightamount = $request->nightamount;
        $expenseType->changeable = $request->changeable ? 1 : 0;
        $expenseType->terminal_deduct = $request->terminal_deduct ? 1 : 0;
        $expenseType->status = $request->status ? 1 : 0;
        $expenseType->refcode  = $request->refcode;

        if($expenseType->save()){
            Session::flash('flash_success', 'ExpenseType updated successfully');
            return redirect()->route('admin.expense_type.index');
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
        $expenseType = ExpenseType::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($expenseType->exists()){
            if($expenseType->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'ExpenseType Delete error. Try later!';
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
    public function status(Request $request, ExpenseType $expenseType)
    {
        if($expenseType->exists())
        {
            $expenseType->status = !$expenseType->status;
            $expenseType->save();
            return response(array('status' => $expenseType->status, 'error' => false, 'msg' => 'ExpenseType Successfully '.($expenseType->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'ExpenseType not found.'));
        }

    }
}
