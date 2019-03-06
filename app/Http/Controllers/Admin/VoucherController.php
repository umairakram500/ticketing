<?php

namespace App\Http\Controllers\Admin;

use App\Models\Boarding;
use App\Models\ExpenseType;
use App\Models\RouteExpense;
use App\Models\Voucher;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VoucherController extends Controller
{
    //use CommenFunctions;
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
        return view('admin.voucher.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $departids = array_keys($request->bord);
        $boards = $request->bord;
        $boadings = Boarding::whereIn('id',$departids)->get();

        if($boadings != null)
        {
            foreach($boadings as $boading){
                $boading->cargo = $boards[$boading->id]['cargo'];
                $boading->en_psgs = $boards[$boading->id]['enpsg'];
                $boading->en_income = $boards[$boading->id]['enincome'];
                $boading->save();
            }
        }

        $voucher = new Voucher();
        $voucher->bus_id = $request->bus_id;
        $voucher->income = $boadings->sum('total_fare')-$boadings->sum('total_discount')+$boadings->sum('en_income')+$boadings->sum('cargo');
        $voucher->terminal_exps = $boadings->sum('total_exp');
        $voucher->route_exps = array_sum(array_column($request->route_exps,'amount'));
        //dd($voucher);
        //$voucher->save();
        $exps = array();
        if($voucher->save()){
            foreach($request->route_exps as $exp){
                if($exp['amount'] > 0){
                    $nexp['bus_id'] = $request->bus_id;
                    $nexp['exptype_id'] = $exp['id'];
                    $nexp['amount'] = $exp['amount'];
                    //$nexp['voucher_id'] = $voucher->id;

                    $exps[] = new RouteExpense($nexp);
                }
            }

            Boarding::whereIn('id',$departids)->update(['voucher_id' => $voucher->id]);

            //$boadings->update(['voucher_id', $voucher->id]);

            $voucher->routeExps()->saveMany($exps);

            return redirect()->route('admin.voucher.show', $voucher->id);

        }




    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::find($id);
        //dd( $voucher->routeExps()->with('expense_type')->get()->pluck('expense_type.title', 'amount')->toArray() );
        $data['voucher'] = $voucher;

        return view('admin.voucher.print', $data);
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
