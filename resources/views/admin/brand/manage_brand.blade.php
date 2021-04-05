@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Brand</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Brand Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Brand Form</li>
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
                    <div class="col-md-4">
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
                                <h3 class="card-title">Add Brand</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form role="form" action="{{route('brand.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Brand Name</label>
                                        <input type="text" name="brand_name" class="form-control" id="exampleInputEmail1" placeholder="Brand Name">
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
                    <div class="col-md-8">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Manage Category information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Brand Name</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->brand_name}}</td>
                                               
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
                                                    <a href="{{route('inactive-brand',[$data->id])}}"
                                                       class="btn btn-success" title="Inactive"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="{{route('active-brand',[$data->id])}}"
                                                       class="btn btn-warning" title="Active"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    <?php } ?>
                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    <a href="{{route('brand.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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