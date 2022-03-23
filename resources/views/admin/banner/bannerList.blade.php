@extends('admin.master')
@section('title')
    Admin Banner List
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
                                <h5 class="m-b-10">Banner Table</h5>
                            </div>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('bannerView')}}">Banner Table</a></li>
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
                                <button type="button" class="btn  btn-primary" data-toggle="modal" data-target="#exampleModal" data-whatever="@getbootstrap"><i class="fa-solid fa-circle-plus"></i> Add Banner</button>
                                <h3 class="text-center text-success">{{Session::get('message')}}</h3>
                            </div>
                            
                            <div class="card-body table-border-style">
                                <div class="table-responsive">
                                    <table class="table responsive nowrap" id="data_Table"  width="100%">
                                        <thead>
                                            <tr class="bg-light">
                                                <td width="5%">Sl</td>
                                                <td width="20%">Title</td>
                                                <td width="30%">Description</td>
                                                <td width="25%">Image</td>
                                                <td width="10%">Status</td>
                                                <td width="10%">Action</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php 
                                            $i=1;
                                            @endphp
                                            @foreach($banners as $banner)
                                                
                                            <tr >
                                                <td>{{$i++}}</td>
                                                <td>{{$banner->title}}</td>
                                                <td>{{$banner->description}}</td>
                                                <td><img src = "{{ asset('/images/bannerImage/'.$banner->banner_image) }}" width="250" height="100" /></td>
                                                <td >{{$banner->status}}</td>
                                                <td style="width: 12%;">
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                                            <i class="fas fa-cog"></i>  <span class="caret"></span>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right" style="border: 1px solid gray;" role="menu">
                                                            <li class="action"><a href="{{route('bannerChangeStatus',$banner->id)}}" class="btn" onclick="return confirm('Are you sure you want to change status of this banner?');"><i class="fas fa-exchange-alt"></i> Change Status </a></li>
                                                            <li class="action"><a href="{{route('bannerDelete',$banner->id)}}" class="btn"  onclick="return confirm('Are you sure you want to delete this item?');"><i class="fas fa-trash"></i> Delete </a></li>
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
                                                <form action="{{route('bannerStore')}}" method="post" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Title</label>
                                                        <input type="text" class="form-control" id="title" name="title" placeholder="Banner Title">
                                                        <span class="text-danger">{{$errors->has('title')?$errors->first('title'):''}}</span>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Desctiption</label>
                                                        <textarea class="form-control" id="description" name="description" placeholder="Description"></textarea>
                                                    </div>
                                                    <div class="form-group">
                                                        <label  class="col-form-label">Banner Image</label>
                                                        <input type="file" class="form-control" id="banner_image" name="banner_image">
                                                        <span class="text-danger">{{$errors->has('banner_image')?$errors->first('banner_image'):''}}</span>
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