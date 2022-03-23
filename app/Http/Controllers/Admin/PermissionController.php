<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
class PermissionController extends Controller
{
    
    public function index()
    {
        $permissions=Permission::all();
        return view('admin.permissions.permissionList',['permissions'=>$permissions]);
    }


    public function store(Request $request)
    {
        $permissions = Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
            'status'    => 'Active',
            ]);

        return redirect('permission/view')->with('message',$request->name. ' saved sucessfully');
    }




    public function edit(Request $request){
        $permissions=Permission::find($request->id);
        return $permissions;
    }

    public function update(Request $request){
            $permissions=Permission::find($request->editId);
            $permissions->name=$request->editName;
            $permissions->group_name=$request->editGroup_name;
            $permissions->updated_by=auth()->user()->id;
            $permissions->save();
            return redirect('permission/view')->with('message',$request->name. ' updated sucessfully');
    }






}
