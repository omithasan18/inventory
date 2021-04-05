@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Customer</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Customer Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Customer Form</li>
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
                    <!--/.col (left) -->
                    <!-- right column -->
                    <div class="col-md-12">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Customer information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Head Customer</th>
                                            <th>Customer Name</th>
                                            <th>Contact Code</th>
                                            <th>Email </th>
                                            <th>Phone</th>
                                            <th>Address</th>
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
                                                <td>{{$data->head_customer->name ?? ''}}</td>
                                                <td>{{$data->customer_name}}</td>
                                                <td>{{$data->contact_code}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->phone}}</td>
                                                <td>{{$data->address}}</td>
                                               
                                            <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td>
                                                <td>
                                                    @php
                                                        if($data->status == 1){
                                                                echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                                            }else{
                                                                echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                            }
                                                    @endphp
                                                </td>
                                                <td>
                                                    <?php  if($data->status == 1){ ?>
                                                    <a href="{{route('inactive-customer',[$data->id])}}"
                                                       class="btn btn-success" title="Inactive"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="{{route('active-customer',[$data->id])}}"
                                                       class="btn btn-warning" title="Active"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    <?php } ?>
                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    <a href="{{route('customer.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                </td>
                                            </tr>
                                        @php $i++; @endphp
                                        @endforeach
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

@endsection
@section('script')

@endsection