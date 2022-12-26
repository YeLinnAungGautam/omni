<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use DB;

class RoleController extends Controller
{
    //
    public function index(Request $request)
    {
        $roles = Role::with("permissions")->orderBy('id','DESC')->get();
        $permission = Permission::get();
        return response()->json([
            'roles'=>$roles,
            'permissions' => $permission
        ], 200);
    }

    public function create()
    {
        $permission = Permission::get();
        return response()->json([
            'permissions'=>$permission,
        ], 200);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name'),'guard_name'=>'api']);
        $role->syncPermissions($request->input('permission'));

        return response()->json([
            'status' => 'success',
        ], 201);
    }

    public function show($id)
    {
        $role = Role::find($id);
        $rolePermissions = Permission::join("role_has_permissions","role_has_permissions.permission_id","=","permissions.id")
            ->where("role_has_permissions.role_id",$id)
            ->get();
        return  response()->json([
            'roles'=>$roles,
            'permissions' => $permission
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission'));


    }

    public function destroy($id)
     {
         DB::table("roles")->where('id',$id)->delete();
         return response()->json([
           "message"=>"success"
         ], 200);
     }
}
