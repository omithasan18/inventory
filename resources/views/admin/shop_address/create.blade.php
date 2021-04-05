@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Shop Address</title>
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Shop Address Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-data"><a href="#">Home</a></li>
                        <li class="breadcrumb-data active">Shop Address Form</li>
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
                            <h3 class="card-title">Shop Address shop-address</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('shop-address.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shop Name</label>
                                    <input type="hidden" value="{{$data->id ?? ''}}" name="shop_id" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Shop Name">
                                    <input type="text" value="{{$data->name ?? ''}}" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Shop Name">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Shop Email</label>
                                    <input type="email" value="{{$data->email ?? ''}}" name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter Your Shop Email">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Phone Number</label>
                                    <input type="text" value="{{$data->phone ?? ''}}" name="phone" class="form-control" id="exampleInputEmail1" placeholder="Phone Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address Line 1</label>
                                    <input type="text" name="address1" class="form-control" id="exampleInputEmail1" value="{{$data->address1 ?? ''}}" placeholder="Enter Your Address">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Address Line 2</label>
                                    <input type="text" name="address2" class="form-control" id="exampleInputEmail1" value="{{$data->address2 ?? ''}}" placeholder="Enter Your Address Line 2">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Website Url</label>
                                    <input type="text" value="{{$data->website_url ?? ''}}" name="website_url" class="form-control" id="exampleInputEmail1" placeholder="Ex:www.example.com">
                                </div>
                                <div class="form-group">
                                    <img src="{{$data->image ?? ''}}" alt="" height="50px" width="50px">
                                    <label for="exampleInputEmail1">Logo</label>
                                    <input type="file" name="image" class="form-control" id="exampleInputEmail1" placeholder="shop-address Name">
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
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Address Line 1</th>
                                        <th>Address Line 2</th>
                                        <th>Logo</th>
                                        {{-- <th>Status</th> --}}
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    {{-- @foreach($data as $data) --}}
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$data->name ?? ''}}</td>
                                        <td>{{$data->email ?? ''}}</td>
                                        <td>{{$data->phone ?? ''}}</td>
                                        <td>{{$data->address1 ?? ''}}</td>
                                        <td>{{$data->address2 ?? ''}}</td>
                                    <td><img src="{{$data->image ?? ''}}" alt="" height="50px" width="50px"></td>
                                    </tr>
                                    @php $i++; @endphp
                                    {{-- @endforeach --}}
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