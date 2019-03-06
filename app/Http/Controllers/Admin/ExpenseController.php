<?php

namespace App\Http\Controllers\Admin;

use App\Models\Expense;
use App\Models\ExpenseType;
use App\Models\Schedule;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpenseController extends Controller
{
    use CommenFunctions;
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
    public function create()
    {
        $data['experse_types'] = $this->toSelect(ExpenseType::where('status', 1)->get()->toArray());
        return view('admin.expense.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Schedule $schedule, Request $request)
    {
        /*$request->validate([
            'expense' => 'array|integer'
        ]);*/
        /*if($request->departure)
            $schedule->expenseDepart()->delete();
        else
            $schedule->expenseReturn()->delete();*/
        //return response($schedule->expenses()->delete());

        if(isset($request->dv) && $request->dv){
            // check depart voucher
            $schedule->departured = 1;
            $schedule->voucher_no = 'DVC'.$schedule->id.date('ymd');
            $schedule->save();
        }

        $expenses = array();
        foreach( $request->expense as $exp_id => $amt)
        {
            if((int)$amt['amt'] > 0){

                if(isset($amt['id']) && $amt['id'] > 0)
                {
                    $exp = Expense::find($amt['id']);
                    $exp->expense_type_id = $exp_id;
                    $exp->amount =  $amt['amt'];
                    $exp->departure = $request->departure;
                    $expenses[] = $exp;
                }
                else {
                    $exp = [
                        'expense_type_id' => $exp_id,
                        'amount' => $amt['amt'],
                        'departure' => $request->departure
                    ];
                    $expenses[] = new Expense($exp);
                }

            }

        }
        
        $schedule->expenses()->saveMany($expenses);

        return response(array('error' => false, 'message' => 'Expenses added Successfully', 'expense' => $request->departure));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
