<?php

namespace App\Http\Controllers\Admin\Cargo;

use App\Http\Requests\CargoRequest;
use App\Models\Cargo\Cargo;
use App\Models\Cargo\CargoItem;
use App\Models\Cargo\Category;
use App\Models\Cargo\GoodsType;
use App\Models\Cargo\PackingType;
use App\Models\Cargo\ShipmentStatus;
use App\Models\City;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Terminal;
use Illuminate\Support\Facades\Session;

class CargoController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Cargo::All();
        return view('admin.cargo.index', ['list' => $list]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = $this->toSelect(Category::options());
        $data['goods_types'] = $this->toSelect(GoodsType::options());
        $data['packings'] = $this->toSelect(PackingType::options());
        $data['cities'] = $this->toSelect(City::options('name'), 'name');
        $data['terminals'] = $this->toSelect(Terminal::Options());

        return view('admin.cargo.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CargoRequest $request)
    {

        if(!count($request->items)){
            return redirect()->back()->withInput();
        }

        $cargo = new Cargo();

        $cargo->s_name = $request->s_name;
        $cargo->s_cnic = $request->s_cnic;
        $cargo->s_phone = $request->s_phone;
        $cargo->s_email = $request->s_email;
        $cargo->s_address = $request->s_address;
        $cargo->r_name = $request->r_name;
        $cargo->r_cnic = $request->r_cnic;
        $cargo->r_phone = $request->r_phone;
        $cargo->r_email = $request->r_email;
        $cargo->r_address = $request->r_address;
        $cargo->r_city = $request->r_city;
        $cargo->r_terminal = $request->r_terminal;
        $cargo->weight = $request->weight;
        $cargo->qty = $request->qty;
        $cargo->charges = $request->charges;

        $cargo->shipment_status_id = 1;
        $cargo->schedule_id = 12;

        $items = array();
        foreach($request->items as $item){
            $items[] = new CargoItem([
                "remarks" => $item["remarks"],
                "category_id" => $item["category"],
                "goods_type_id" => $item["goods_type"],
                "packing_type_id" => $item["packing"],
                "qty" => $item["qty"],
                "weight" => $item["weight"]]);
        }


        if($cargo->save())
        {
            $cargo->items()->saveMany($items);
            Session::flash('flash_success', 'Cargo added successfully');
        }
        else {
            Session::flash('flash_error', 'Cargo add error. Try later');
        }
        return redirect()->route('admin.cargo.create');



    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cargo $cargo)
    {
        $data['shipments'] = ShipmentStatus::where('status', 1)->get();
        $data['cargo'] = $cargo;

        return view('admin.cargo.show', $data);
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
