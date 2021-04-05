@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Head Customer</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Customer</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Customer</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-5">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">Add Head Customer</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('head-customer.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Name</label>
                                        <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Business Name</label>
                                        <input type="text" name="business_name" class="form-control" id="exampleInputEmail1" placeholder="Business Address">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input type="email" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Email">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone</label>
                                        <input type="text" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Enter Phone">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Business Address</label>
                                        <textarea type="text" name="business_address" class="form-control" id="exampleInputEmail1" placeholder="Business Name"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Image</label>
                                        <input type="file" name="image" class="form-control" id="exampleInputEmail1" placeholder="Role Title">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Publication Status</label>
                                                <select class="custom-select" name="status">
                                                    <option value="1">Active</option>
                                                    <option value="0">Inactive</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </div>
                            </form>
                        </div>
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-7">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Payment information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Name</th>
                                            <th>Business Name</th>
                                            <th>Phone</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1; @endphp
                                            @foreach($datas as $data)
                                                <tr>
                                                    <td>{{$i}}</td>
                                                    <td>{{$data->name}}</td>
                                                    <td>{{$data->business_name}}</td>
                                                    {{-- <td>{{$data->email}}</td> --}}
                                                    <td>{{$data->phone}}</td>
                                                <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td>
                                                    <td>@php
                                                            if($data->status == 1){
                                                            echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                                            }else{
                                                            echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                            }
                                                        @endphp
                                                    </td>
                                                    <td>
                                                        <?php  if($data->status == 1){ ?>
                                                        <a href="{{route('inactive-head-customer',[$data->id])}}"
                                                           class="btn btn-success" title="Inactive"><i
                                                                    class="fa fa-arrow-down"></i></a>
                                                        <?php }else{ ?>
                                                        <a href="{{route('active-head-customer',[$data->id])}}"
                                                           class="btn btn-warning" title="Active"><i
                                                                    class="fa fa-arrow-up"></i></a>
                                                        <?php } ?>
                                                        {{-- <form action="{{route('role.destroy',[$data->id])}}" method="post">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                        </form> --}}
    
    
                                                        <a href="{{route('head-customer.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        <a href="#"  style="display: inline;" class="btn btn-warning" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                                                            data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></a>
                                                    </td>
                                                </tr>
                                            @php $i++; @endphp
                                            @endforeach
                                            </tbody>
                                    </table>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card-header -->

                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!--/.col (right) -->
                </div>
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
{{-- model --}}
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
aria-hidden="true">
<div class="modal-dialog modal-lg">
   <div class="modal-content">
       <div class="modal-header">
           <!-- <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5> -->
           <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseModelHandler()">
               <span aria-hidden="true">&times;</span>
           </button>
       </div>
       <div class="modal-body">
           <div id="view-model">
               

               Content goes here....

           </div>
           

       </div>
   </div>
</div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    var token = $("input[name=_token]").val();
    function ViewPaymentInfo(id) {
        var datastr = "id=" + id + "&token=" + token;
        $.ajax({
            type: "POST",
            url: "<?php echo route('get-head-customer-information'); ?>",
            data: datastr,
            cache: false,
            success: function(data) {
                $('#view-model').html(data);
            },
            error: function(jqXHR, status, err) {
//                    alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });
        
    }

</script>
@endsection