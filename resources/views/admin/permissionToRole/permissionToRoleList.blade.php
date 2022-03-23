@extends('admin.master')
@section('title')
    Admin Permission To Role
@endsection


@section('content')
<section>
    <div class="pc-container">
        <div class="pcoded-content">

            <!-- [ breadcrumb ] start -->
            <div class="page-header">
                <div class="page-block">
                    <div class="row align-items-center">
                        <div class="col-md-12">
                            <div class="page-header-title">
                                <h5 class="m-b-10">Permissions</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('rolesList')}}">Permissions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <!-- [ breadcrumb ] end -->
            <div class="row">
                <!-- card start -->
                    <div class="col-md-12">
                        <div class="card">
                            <!-- Card Content start -->
                            <div class="card-header">
                            @if(Auth::guard('web')->user()->can('rolePermission.store'))
                            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa-solid fa-circle-plus"></i> Add Permissions</button>
                            @endif
                            <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                            </div>
                            
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table responsive nowrap" id="data_Table"  width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <td width="5%" class="text-center">Sl</td>
                                                <td width="20%">Role Name</td>
                                                <td width="65%">Permissions</td>
                                               
                                                <td width="8%" class="text-center">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                            $i=1;
                                            @endphp
                                            @foreach($roles as $role)
                                                
                                            <tr >
                                                <td class="text-center">{{$i++}}</td>
                                                
                                                <td>{{$role->name}}</td>
                                                <td >
                                               @foreach($role->permissions as $perm)
                                                <span  class="badge bg-info text-dark mr-1">
                                                    {{ $perm->name }}
                                                </span>
                                               @endforeach
                                                </td>
                                                
                                                <td style="width: 12%;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                                                     
                                                            <li type="button" class="btn " onclick="editProduct({{$role->id}})"><i class="fa fa-edit"></i>Edit</li>
                                                        
                                                        @if(Auth::guard('web')->user()->can('rolePermission.delete'))
                                                            <li class="action"><a href="{{route('roleDelete',$role->id)}}" class="btn"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i> Delete </a></li>
                                                        @endif
                                                        </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div><!-- Card Content end -->

                            <!-- create Model Start -->
                            <div class="card-body btn-page">
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                            <form method="POST" action="{{route('roleToPermissionStore')}}">
                                            @csrf
                                            <div class="row">

                                                <div class="form-group">
                                                    <label for="email" class=" col-form-label">Role Name :</label>
                                                    <div>
                                                        <select class="form-control" name="role_id" id="role_id">
                                                            <option disabled selected>Select Roles</option>
                                                        @foreach($roles as $role)
                                                            <option value="{{$role->id}}">{{$role->name}}</option>
                                                        @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <p class="font-weight-bold">Permissions</p>
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" id="checkPermissionAll"
                                                            value="1">
                                                        <label class="form-check-label" for="checkPermissionAll">All</label>
                                                    </div>

                                                    @php
                                                        $i = 1;
                                                    @endphp

                                                    @foreach ($permissions as $group)
                                                    <div class="row">
                                                            <div>
                                                                <div class="form-check">
                                                                    <input name="permissions[]" class="form-check-input" type="checkbox"
                                                                        id="{{ $i }}Management"
                                                                        value="{{ $group->name }}"
                                                                        onclick="checkPermissionByGroup('role-{{ $i }}-management-checkBox', this);">
                                                                    <label class="form-check-label text-capitalize"
                                                                        for="checkPermission">{{ $group->name }}</label>
                                                                </div>
                                                            </div>
                                                         
                                                            <div class=" role-{{ $i }}-management-checkBox" >
                                                                @php
                                                                    $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                                                    $j = 1;
                                                                @endphp
                                                                @foreach ($permissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]"
                                                                            id="checkPermission{{ $permission->id }}"
                                                                            value="{{ $permission->name }} 989">
                                                                        <label class="form-check-label text-capitalize" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                                    </div>
                                                                    @php $j++; @endphp
                                                                @endforeach
                                                            </div>
                                                    </div>
                                                    @endforeach



                                                    @php 
                                                        $i++; 
                                                        @endphp
                                                        
                                                        @foreach ($permissions as $permission)
                                                        <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]"  id="checkPermission{{$permission->id}}" value="{{ $permission->name }}">
                                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                        @endforeach
                                                    
                                                  
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-secondary mr-auto" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn  btn-primary">Save</button>
                                                    </div>
                                            </div>
                                            </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- create model End -->

                             <!-- update Model Start -->
                             <div class="card-body btn-page">
                                <div class="modal fade" id="editModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add Banner</h5>
                                                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="{{route('permissionUpdate')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" id="editId" name="editId">
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Permission Name</label>
                                                        <input type="text" class="form-control" id="editName" name="editName" placeholder="Name">
                                                        <span class="text-danger">{{$errors->has('title')?$errors->first('title'):''}}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Permission Group</label>
                                                        <input type="text" class="form-control" id="editGroup_name" name="editGroup_name" placeholder="Group Name">
                                                        <span class="text-danger">{{$errors->has('title')?$errors->first('title'):''}}</span>
                                                    </div>
                                                   
                                                   
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn  btn-secondary mr-auto" data-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn  btn-primary">Save</button>
                                                    </div>
                                                </form>
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div><!-- update model End -->

                        </div>
                    </div><!-- Card end -->
            </div><!-- row end -->
        </div><!-- pcoded-content end -->
    </div><!-- pc-container end -->
    
</section>
@endsection


@section('javascript')

<script>
    $(document).ready(function() {
    $('#data_Table').DataTable({
        responsive: true
    });
    });



    function editProduct(id){
        $.ajax({
                url: "{{route('editPermission') }}",
                method: "GET",
                data: {"id": id},
                datatype: "json",
                success: function(result) {
                    //alert(JSON.stringify(result));
                    $("#editModel").modal('show');
                    $("#editId").val(result.id);
                    $("#editName").val(result.name);
                    $("#editGroup_name").val(result.group_name);
                },
                beforeSend: function() {
                    $('#loading').show();
                },
                complete: function() {
                    $('#loading').hide();
                }
            });
        }
   

        $("#checkPermissionAll").click(function() {
            if ($(this).is(':checked')) {
                $("input[type=checkbox]").prop('checked', true);
            } else {
                $("input[type=checkbox]").prop('checked', false);
            }
        });


        const checkPermissionByGroup = (className, checkThis) => {
            const groupIdName = $('#' + checkThis.id);
            const classCheckBox = $('.' + className + ' input');
            if (groupIdName.is(':checked')) {
                classCheckBox.prop('checked', true);
            } else {
                classCheckBox.prop('checked', false);
            }
        }

</script>

@endsection