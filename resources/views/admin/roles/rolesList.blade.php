@extends('admin.master')
@section('title')
    Admin Role List
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
                                <h5 class="m-b-10">Roles</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('rolesList')}}">Roles</a></li>
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
                          
                            <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa-solid fa-circle-plus"></i> Add Roles</button>
                            
                                <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                            </div>
                            
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table responsive nowrap" id="data_Table"  width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <td width="5%" class="text-center">Sl</td>
                                                <td width="30%">Name</td>
                                               <td width="42">Guard Name</td>
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
                                                <td>{{$role->guard_name}}</td>
                                                <td style="width: 12%;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                                                       
                                                            <li class="action"><a href="{{route('roleDelete',$role->id)}}" class="btn"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i> Delete </a></li>
                                                        
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
                                                <form action="{{route('roleStore')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Role Name</label>
                                                        <input type="text" class="form-control" id="name" name="name" placeholder="Role Name">
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
                            </div><!-- create model End -->
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
</script>

@endsection