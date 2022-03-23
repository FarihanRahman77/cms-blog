@extends('admin.master')
@section('title')
    Admin User List
@endsection












@section('content')
<!--  BEGIN CONTENT AREA  -->
<div id="content" class="main-content">
            <div class="layout-px-spacing">
                
                <div class="row layout-top-spacing">
                
                    <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                        <!-- Card Content start -->
                        
                           <a class="btn btn-primary" href="{{route('userCreate')}}" style="color:#fff;"><i class="fa-solid fa-circle-plus"></i> Add User</a>
                           <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                       
                        <div class="widget-content widget-content-area br-6">
                            
                                    <table class="table responsive nowrap" id="dataTable"  width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <td width="5%" class="text-center">Sl</td>
                                               
                                                <td width="15%">Name</td>
                                               <td width="25%">Email</td>
                                               <td width="35%">Roles</td>
                                                <td width="8%" class="text-center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                            $i=1;
                                            @endphp
                                            @foreach($users as $user)
                                                
                                            <tr >
                                                <td class="text-center">{{$i++}}</td>
                                                
                                                <td>{{$user->name}}</td>
                                               <td>{{$user->email}}</td>
                                               <td>
                                               @foreach($user->roles as $role)
                                                <span  class="badge bg-info text-dark mr-1">
                                                    {{ $role->name }}
                                                </span>
                                               @endforeach
                                               </td>
                                                <td style="width: 12%;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right"  style="border: 1px solid gray;" role="menu">
                                                        
                                                            <li class="action"><button class="btn" onclick="editUser({{$user->id}})"><i class="fas fa-edit"></i> Edit</button></li>
                                                        
                                                        @if(Auth::guard('web')->user()->can('rolePermission.delete'))
                                                            <li class="action"><a href="{{route('userDelete',$user->id)}}" class="btn"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i> Delete </a></li>
                                                        @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                            
                        </div>
                    </div>

                </div>
            </div>

                    <!-- create Model Start -->
                    <div class="card-body btn-page">
                                <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Edit User</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('userUpdate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf

                                                    <input type="hidden" id="id" name="id">
                                                    <div class="row">
                                                        <div class="form-group col-md-6">
                                                            <label for="name"  class="col-form-label">Name</label>
                                                            <input type="text" class="form-control" id="name" name="name" >
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="email"  class="col-form-label">Email</label>
                                                            <input type="email" class="form-control" id="email" name="email" >
                                                        </div>

                                                        <div class="form-group col-md-6">
                                                            <label for="password" class="col-form-label">Password</label>
                                                            <input type="password" class="form-control" id="password" name="password" >
                                                        </div>

                                                        

                                                        <div class="form-group col-md-12">
                                                            <label for="" value="Assign Role"  class="col-form-label">Role</label>
                                                            <select type="text" class="form-select" id="roles" name="roles">
                                                                <option selected disabled>Choose role</option>
                                                                @foreach($roles as $role)
                                                                <option value="{{$role->name}}">{{$role->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-secondary mr-auto" data-bs-dismiss="modal" aria-label="Close">X Close</button>
                                                        <button type="submit" class="btn  btn-primary"><i class="fas fa-save"></i> Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- create model End -->



            <div class="footer-wrapper">
                <div class="footer-section f-section-1">
                    <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com">DesignReset</a>, All rights reserved.</p>
                </div>
                <div class="footer-section f-section-2">
                    <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
                </div>
            </div>
        </div>
        <!--  END CONTENT AREA  -->
@endsection
















@section('javascript')

<script>
   $(document).ready(function() {
        $('#dataTable').DataTable();
    } );

    function editUser(id){
        //alert(id);
        $.ajax({
                url: "{{route('editUser') }}",
                method: "GET",
                data: {"id": id},
                datatype: "json",
                success: function(result) {
                    //alert(JSON.stringify(result));
                    $("#editModel").modal('show');
                    $("#id").val(result.id);
                    $("#name").val(result.name);
                    $("#email").val(result.email);
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }
</script>

@endsection