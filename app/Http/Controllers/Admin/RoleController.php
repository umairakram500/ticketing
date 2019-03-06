<?php

namespace App\Http\Controllers\Admin;

use App\Models\Roles\RolesPermission;
use App\Models\Roles\Role;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::All();

        return view('admin.roles.index', ['roles' => $roles]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.roles.create');
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
            'name' => 'required|max:191|unique:roles,name',
            'slug' => 'required|max:191|unique:roles,slug',
            'permissions' => 'required|array',

        ]);
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;

        if($role->save()){
            //DB::table('users_permissions')->where('user_id', $user->id)->delete();
            if($request->permissions != null){
                foreach($request->permissions as $permission){
                    $role->permissions()->attach($permission);
                }
            }
            return redirect()->route('admin.roles.index')->with('flash_success', 'Role added successfully');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Roles\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  App\Models\Roles\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = array_column($role->permissions()->select('id')->get()->toArray(), 'id');
        return view('admin.roles.edit', ['role' => $role, 'role_permssions' => $permissions]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Roles\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => 'required|max:191|unique:roles,name,'.$role->id,
            'slug' => 'required|max:191|unique:roles,slug,'.$role->id,
            'permissions' => 'required|array'
        ]);

        $role->name = $request->name;
        $role->slug = $request->slug;

        if($role->save()){
            //DB::table('roles_permissions')->where('role_id', $role->id)->delete();
            //$permissions = Permission::whereIn('id', $request->permissions)->get();
            foreach($request->permissions as $permission){
                RolesPermission::firstOrCreate(['permission_id' => $permission, 'role_id' => $role->id]);
            }
                //$role->permissions()->attach($permission);

            return redirect()->route('admin.roles.index')->with('flash_success', 'Role added successfully');
        }


    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Roles\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $role = Role::find($id);
        $error = true;
        $message = 'Role not found.';
        if($role->exists()){
            if($role->delete()){
                $error = false;
                $message = 'Role Delete successfully.';
            } else {
                $message = 'Role Delete error. Try later!';
            }
        } else {
            $error = true;

        }
        return response(['msg' => $message, 'error' => $error]);
    }
}
