<?php

namespace App\Http\Controllers\Admin\Cargo;

use App\Models\Cargo\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Category::All();
        //dd($list);
        return view('admin.cargo.category.index', ['list' => $list]);
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

        $category = $request->id > 0 ? Category::find($request->id) : new Category();
        $category->title = $request->title;

        if($category->save()){
            Session::flash('flash_success', 'Category '.($request->id?'added':'updated').' successfully');
            return redirect()->route('admin.cargo.category.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        return view("admin.cargo.category.show", $category);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //$category = Category::find($id);
        return response($category);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|max:255',
            'status' => 'boolean'
        ]);
        $category->name = $request->name;

        if($category->save()){
            Session::flash('flash_success', 'Category updated successfully');
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
        $category = Category::find($id);
        $error = true;
        $message = 'Recode not found.';
        if($category->exists()){
            if($category->delete()){
                $error = false;
                $message = 'Recode Delete successfully.';
            } else {
                $message = 'Category Delete error. Try later!';
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
    public function status(Category $category)
    {
        if($category->exists())
        {
            $category->status = !$category->status;
            $category->save();
            return response(array('status' => $category->status, 'error' => false, 'msg' => 'Category Successfully '.($category->status?"Activated":"Deactivated") ));
        }
        else {
            return response(array('error' => true, 'msg' => 'Category not found.'));
        }

    }
}
