@extends('admin.master')
@section('title')
    Admin Create User Permission
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
                                <h5 class="m-b-10">User Table</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('userList')}}">Users</a></li>
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
                                <h3 class="m-b-10">Create User Permission</h3>
                                <h3 class="text-center text-success"><x-jet-validation-errors class="mb-4" /></h3>
                            </div>
                            
                            <div class="card-body ">
                               <div class="row">
                                    <div class="col-md-2"></div>
                                    <div class="col-md-8">
                                        <div class="form">
                                        <form method="POST" action="">
                                            @csrf
                                            <div class="row">

                                                <div class="form-group">
                                                        <label for="email" class=" col-form-label">Role Name :</label>
                                                    <div>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Enter Role Name..."> 
                                                            
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <p class="font-weight-bold">Permissions</p>
                                                    
                                                    <div class="form-check ">
                                                        <input class="form-check-input" type="checkbox" id="checkPermissionAll"
                                                            value="1">
                                                        <label class="form-check-label" for="checkPermissionAll">All</label>
                                                        <hr>
                                                    </div>
                                                    @php
                                                        $i = 1;
                                                    @endphp
                                                    @foreach ($permissionGroups as $group)
                                                        <div class="row">
                                                            <div class="col-3" >
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="checkbox"
                                                                        id="{{ $i }}Management"
                                                                        value="{{ $group->name }}"
                                                                        onclick="checkPermissionByGroup('role-{{ $i }}-management-checkBox', this);">
                                                                    <label class="form-check-label text-capitalize"
                                                                        for="checkPermission">{{ $group->name }}</label>
                                                                </div>
                                                            </div>
                                                         
                                                            <div class="col-md-9 role-{{ $i }}-management-checkBox" >
                                                                @php
                                                                    $permissions = App\Models\User::getPermissionsByGroupName($group->name);
                                                                    $j = 1;
                                                                @endphp
                                                                @foreach ($permissions as $permission)
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="checkbox"
                                                                            name="permissions[]"
                                                                            id="checkPermission{{ $permission->id }}"
                                                                            value="{{ $permission->name }}">
                                                                        <label class="form-check-label text-capitalize" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                                    </div>
                                                                    @php $j++; @endphp
                                                                @endforeach
                                                            </div>
                                                        </div>
                                                        <hr> 
                                                        @php $i++; @endphp
                                                    @endforeach
                                                    {{-- @foreach ($permissions as $permission)
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="checkbox" name="permissions[]"  id="checkPermission{{ $permission->id }}" value="{{ $permission->name }}">
                                                                <label class="form-check-label" for="checkPermission{{ $permission->id }}">{{ $permission->name }}</label>
                                                            </div>
                                                        @endforeach --}}
                                                </div>
                                                <button class="btn btn-lg btn-primary">Save</button>
                                            </div>
                                    </form>
                                        </div>
                                    </div>
                                    <div class="col-md-2"></div>
                               </div>
                            </div><!-- Card Content end -->
                        </div>
                    </div><!-- Card end -->
            </div><!-- row end -->
        </div><!-- pcoded-content end -->
    </div><!-- pc-container end -->
    
</section>
@endsection


@section('javascript')
    <script>
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