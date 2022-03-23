<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin\User;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;
use DB;

class PermissionToRoleController extends Controller
{
    public function index(){
        
        $permissions=Permission::all();
        $roles=Role::where('deleted','=','No')->get();
        return view('admin.permissionToRole.permissionToRoleList',['permissions'=>$permissions,'roles'=>$roles]);

        $user=Auth::user();
        if($user->can('rolePermission.view '))
        {
           
        }
        else
        {
            abort(403,'You cannot give Permission to roles');
        }
       
    }


  public function store(Request $request){

    $user=Auth::user();
    if($user->can('rolePermission.view ')){
        $request->validate([
            'role_id' => 'required'
            ]); 
    
            $role = Role::find($request->role_id);
            $permissions = $request->input('permissions');
            if (!empty($permissions)) {
                $role->syncPermissions($permissions);
            }
            return  redirect ('permission/to/role/view')->with('message','Permission Assigned sucessfully');
    }
    else
    {
        abort(403,'You cannot give Permission to roles');
    }
    
  }



}
