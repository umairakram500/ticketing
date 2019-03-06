<?php

namespace App\Http\Controllers\Admin\Bus;

use App\Models\Bus\LuxuryType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LuxuryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = LuxuryType::All();

        return view('admin.bus.luxurytype.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.bus.luxurytype.create");
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
            'title' => 'required|max:255|unique:luxury_types,title',
            'status' => 'boolean',
            'remarks' => 'string|nullable',
        ]);
        $luxurytype = new LuxuryType();
        $luxurytype->title = $request->title;
        $luxurytype->seats = $request->seats;
        $luxurytype->status = $request->status ? 1 : 0;

        if($luxurytype->save()){
            Session::flash('flash_success', 'LuxuryType added successfully');
            return redirect()->route('admin.bus.luxurytype.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(LuxuryType $luxurytype)
    {
        return view("admin.bus.luxurytype.show", $luxurytype);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(LuxuryType $luxurytype)
    {
       // dd($luxurytype);
        return view("admin.bus.luxurytype.edit", ['luxurytype' => $luxurytype]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LuxuryType $luxurytype)
    {
        $request->validate([
            'title' => 'required|max:255|unique:luxury_types,title',
            'status' => 'boolean',
            'remarks' => 'string|nullable',
        ]);
        $luxurytype->title = $request->title;
        $luxurytype->seats = $request->seats;
        $luxurytype->status = $request->status ? 1 : 0;

        if($luxurytype->save()){
            Session::flash('flash_success', 'LuxuryType updated successfully');
            return redirect()->route('admin.bus.luxurytype.index');
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
        $luxurytype = LuxuryType::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($luxurytype->exists()){
            if($luxurytype->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'LuxuryType Delete error. Try later!';
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
    public function status(LuxuryType $luxurytype)
    {
        //dd($luxurytype);
        if($luxurytype->exists())
        {
            $luxurytype->status = !$luxurytype->status;
            $luxurytype->save();
            return response(array('status' => $luxurytype->status, 'error' => false, 'msg' => 'LuxuryType Successfully '.($luxurytype->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Luxury Type not found.'));
        }

    }
}
