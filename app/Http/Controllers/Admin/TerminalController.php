<?php

namespace App\Http\Controllers\Admin;

use App\Models\City;
use App\Models\ExpensetypeTerminal;
use App\Models\Terminal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class TerminalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Terminal::All();
        return view('admin.terminal.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::selection('name');

        return view("admin.terminal.create", ['cities' => $cities, 'expenses' => []]);
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
            'title' => 'required|string|max:191|unique:terminals,title',
            'city_id' => 'required|integer|exists:cities,id',
            'status' => 'boolean',
            'address' => 'string|nullable',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable'
        ]);
        $terminal = new Terminal();
        $terminal->title    = $request->title;
        $terminal->city_id  = $request->city_id;
        $terminal->status   = $request->status ? 1 : 0;
        $terminal->address  = $request->address;
        $terminal->lat      = $request->lat;
        $terminal->lng      = $request->lng;
        $terminal->refcode  = $request->refcode;
        $terminal->terminal_type      = $request->terminal_type;

        if($terminal->save()){
            $this->saveExpenses($terminal, $request->expenses);
            Session::flash('flash_success', 'Terminal added successfully');
            return redirect()->route('admin.terminal.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Terminal $terminal)
    {
        return view("admin.terminal.show", $terminal);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Terminal $terminal)
    {
        $data['cities'] = City::selection('name');
        $data['terminal'] = $terminal;
        $data['expenses'] = array();
        $expenses = $terminal->expenses;
        if(count($expenses)){
            foreach($expenses as $expense){
            $data['expenses'][$expense->bustype_id][$expense->expensetype_id]['amount'] = $expense->amount;
            $data['expenses'][$expense->bustype_id][$expense->expensetype_id]['per_seat'] = $expense->per_seat;
            }
        }

        //dd($data);

        return view("admin.terminal.edit", $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Terminal $terminal)
    {
        $request->validate([
            'title' => 'required|string|max:191|unique:terminals,title,'.$terminal->id,
            'city_id' => 'required|integer|exists:cities,id',
            'status' => 'boolean',
            'address' => 'string|nullable',
            'lat' => 'numeric|nullable',
            'lng' => 'numeric|nullable'
        ]);

        $terminal->title    = $request->title;
        $terminal->city_id  = $request->city_id;
        $terminal->status   = $request->status ? 1 : 0;
        $terminal->address  = $request->address;
        $terminal->lat      = $request->lat;
        $terminal->lng      = $request->lng;
        $terminal->refcode  = $request->refcode;
        $terminal->terminal_type = $request->terminal_type;

        //dd($request->expenses);

        if($terminal->save()){
            $this->saveExpenses($terminal, $request->expenses);
            Session::flash('flash_success', 'Terminal updated successfully');
            return redirect()->route('admin.terminal.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Terminal $terminal)
    {
        //$terminal = Terminal::find($id);
        $error = true;
        $message = 'Terminal not found.';
        if($terminal->exists()){
            if($terminal->delete()){
                $error = false;
                $message = 'Terminal Deleted successfully.';
            } else {
                $message = 'Terminal Delete error. Try later!';
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
    public function status(Request $request, Terminal $terminal)
    {
        $response = array('error' => true, 'msg' => 'Terminal not found.');
        if($terminal->exists())
        {
            $terminal->status = !$terminal->status;
            $terminal->save();
            $response = array(
                'status' => $terminal->status,
                'error' => false,
                'msg' => 'Terminal Successfully '.($terminal->status?"Activated":"Deactivated")
            );
        }
        return response($response);
    }

    public function saveExpenses($terminal, $expenses)
    {
        if(count($expenses))
        {
            foreach($expenses as $id => $exps) {
                foreach ($exps as $expid => $expamt) {
                    ExpensetypeTerminal::updateOrCreate(
                        ['terminal_id' => $terminal->id, 'expensetype_id' => $expid, 'bustype_id' => $id],
                        ['amount' => $expamt['amount'], 'per_seat' => isset($expamt['per_seat'])?1:0 ]
                    );
                }
            }
        }

    }
}
