<?php

namespace App\Http\Controllers\Admin\Cargo;

use App\Models\Cargo\GoodsType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class GoodsTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = GoodsType::All();
        //dd($list);
        return view('admin.cargo.goodstype.index', ['list' => $list]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.cargo.category.create");
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
            'title' => 'required|max:255',
            'status' => 'boolean'
        ]);
        if($request->id > 0)
            $goodsType = GoodsType::find($request->id);
        else
            $goodsType = new GoodsType();
        //$goodsType = new GoodsType();
        $goodsType->title = $request->title;
        //$goodsType->status = $request->status ? 1 : 0;

        if($goodsType->save()){
            Session::flash('flash_success', 'GoodsType '.($request->id?'added':'updated').' successfully');
            return redirect()->route('admin.cargo.goodstype.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(GoodsType $goodsType)
    {
        return view("admin.cargo.category.show", $goodsType);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(GoodsType $goodstype)
    {
        //$goodsType = GoodsType::find($id);
        return response($goodstype);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, GoodsType $goodsType)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'boolean'
        ]);
        $goodsType->name = $request->name;
        //$goodsType->status = $request->status ? 1 : 0;

        if($goodsType->save()){
            Session::flash('flash_success', 'GoodsType updated successfully');
            return redirect()->route('admin.cargo.category.index');
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
        $goodsType = GoodsType::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($goodsType->exists()){
            if($goodsType->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'GoodsType Delete error. Try later!';
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
    public function status(GoodsType $goodsType)
    {
        // return response($goodsType);
        if($goodsType->exists())
        {
            $goodsType->status = !$goodsType->status;
            $goodsType->save();
            return response(array('status' => $goodsType->status, 'error' => false, 'msg' => 'GoodsType Successfully '.($goodsType->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'GoodsType not found.'));
        }

    }
}
