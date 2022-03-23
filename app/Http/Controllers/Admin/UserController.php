<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

use Spatie\Permission\Traits\HasRoles;
use Image;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
       
            $roles=Role::where('deleted','=','No')->get();
            $users=User::where('deleted','=','No')->get();
            return view('admin.User.userList',['users'=>$users,'roles'=>$roles]);
        

        
       
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $roles=Role::where('deleted','=','No')->get();
        return view('auth.register',['roles'=>$roles]);
        // }else{
        //     abort(403,'You cannot create user list');
        // }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {  
        
        $user=Auth::user();
        // if($user->can('user.store')){
             $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
                'password'=> 'min:8'
            ]); 
    
      
      

            $confirm=$request->password_confirmation;
            $user=new User();
            $user->name= $request->name;
            $user->email=$request->email;
            $user->image=$imageName;
            $user->password=Hash::make($request->password);
            $user->status ='Active';
            $user->created_by = auth()->user()->id;
            $user->deleted ='No';
    
           
            if($confirm==$request->password){
                $user->save();
                
                $user->assignRole($request->role);
            
                return redirect('user/view')->with('message','User saved sucessfully');
            }else{
                return back()->with('message','User not saved');
            }
        // }else{
        //     abort(403,'You cannot create new user');

        // }
       
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        
            $user=User::find($request->id);
        return $user;
        
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
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

 


    public function updateUser(Request $request){

       
            $validated = $request->validate([
                'name' => 'required|max:255',
                'email' => 'required|email',
           
            ]); 
    
            $user=User::find($request->id);
            $user->name=$request->name;
            $user->email=$request->email;
            if($request->password){
                $user->password=Hash::make($request->password);
            }
            $user->last_updated_by = auth()->user()->id;
            $user->save();
            $user->roles()->detach();
            if($request->roles){
                $user->assignRole($request->roles);
            }
            return redirect('user/view')->with('message','User updated sucessfully');
        
       
    }





    public function delete($id){
      
            $user=User::find($id);
            $user->status="Inactive";
            $user->deleted="Yes";
            $user->deleted_by=auth()->user()->id;
            $user->save();
            return redirect('user/view')->with('message','User deleted sucessfully');
        
       
    }







   
}
