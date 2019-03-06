<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\DoRegister;
use App\Models\City;
use App\Models\Roles\Role;
use App\Models\Terminal;
use App\Models\User;
use App\Traits\CommenFunctions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    use CommenFunctions;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['users'] = User::all();

        return view('admin.user.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.create');
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
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required',
            'cnic' => 'nullable',
            'city_id' => 'required|integer|exists:cities,id',
            'terminal_id' => 'required|integer|exists:terminals,id',
            'dept_id' => 'integer|exists:departments,id',
            'design_id' => 'integer|exists:designations,id',
            'password' => 'required|min:6|password',
            'repass' => 'required|same:password'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->cnic = $request->cnic;
        $user->city_id = $request->city_id;
        $user->terminal_id = $request->terminal_id;
        $user->dept_id = $request->dept_id;
        $user->design_id = $request->design_id;
        $user->password = bcrypt($request->password);
        $user->role_id = $request->role_id;


        if($request->hasFile('avatar')){
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('avatar')->storeAs('public/images', $fileNameToStore);
            $user->avatar = $fileNameToStore;
        }

        if($user->save()){

            if(isset($request->permissions) && count($request->permissions)){
                foreach($request->permissions as $permission){
                    $user->givePermissionsTo($permission);
                }
            }
            return redirect()->route('admin.users.index')->with('flash_success', 'User Add Successfully.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        dd($user->hasRole('developer'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $data['user'] = $user;
        return view('admin.user.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:191',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'phone' => 'required',
            'cnic' => 'nullable',
            'city_id' => 'required|integer|exists:cities,id',
            'terminal_id' => 'required|integer|exists:terminals,id',
            'dept_id' => 'integer|exists:departments,id',
            'design_id' => 'integer|exists:designations,id',
        ]);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->cnic = $request->cnic;
        $user->city_id = $request->city_id;
        $user->terminal_id = $request->terminal_id;
        $user->dept_id = $request->dept_id;
        $user->design_id = $request->design_id;
        $user->role_id = $request->role_id;

        // upload image
        if($request->hasFile('avatar')){
            $fileNameWithExt = $request->file('avatar')->getClientOriginalName();
            $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
            $extension = $request->file('avatar')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$extension;
            $path = $request->file('avatar')->storeAs('public/avatars', $fileNameToStore);
            $user->avatar = $fileNameToStore;
        }

        if($user->save()){
            DB::table('users_permissions')->where('user_id', $user->id)->delete();
            if($request->permissions != null){
                foreach($request->permissions as $permission){
                    $user->givePermissionsTo($permission);
                }
            }

            return redirect()->route('admin.users.index')->with('flash_success', 'User updated Successfully.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $message = 'User Delete error. Try later!';
        $error = true;
        if($user->exists()){
            if($user->delete()){
                $error = false;
                $message = 'User Delete successfully.';
            }
        }
        return response(['msg' => $message, 'error' => $error]);
    }
}
