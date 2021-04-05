@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Edit Distributed</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Distributed Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Distributed Form</li>
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
                                <h3 class="card-title">Add Distributed</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('distributed.update',$distributed->id)}}" method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Distributed Name</label>
                                    <input type="text" value="{{$distributed->distributed_name}}" name="distributed_name" class="form-control" id="exampleInputEmail1" placeholder="Distributed Name">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Distributed Location</label>
                                        <input type="text" value="{{$distributed->location}}" name="location" class="form-control" id="exampleInputEmail1" placeholder="Distributed Location">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Distributed Phone</label>
                                        <input type="text" value="{{$distributed->phone}}" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Distributed Phone">
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Publication Status</label>
                                                <select class="custom-select" name="status">
                                                    <option value="1" @php if ($distributed['status'] == 1) { echo "selected"; } @endphp>Active</option>
                                                    <option value="0" @php if ($distributed['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
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
                                    <h3 class="card-title">Manage Payment information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Distributed Name</th>
                                            <th>Distributed Location</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @php $i=1; @endphp
                                            @foreach($datas as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->distributed_name}}</td>
                                                <td>{{$data->location}}</td>
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
                                                    <a href="{{route('inactive-distributed',[$data->id])}}"
                                                       class="btn btn-success" title="Inactive"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="{{route('active-distributed',[$data->id])}}"
                                                       class="btn btn-warning" title="Active"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    <?php } ?>
                                                    {{-- <form action="{{route('role.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    <a href="{{route('distributed.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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

@endsection
@section('script')

@endsection