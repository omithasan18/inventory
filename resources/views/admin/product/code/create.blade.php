@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Customer Product Code</title>
<style>
    .select2-container .select2-selection--single{
        height: 39px !important;
    }

    body { background-color:#fafafa;}
    .container { margin: 150px auto; }
    h2 { margin:20px auto; font-size:14px;}
    .badge { margin: 2px 5px; }

</style>
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Product Code Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Customer Product Code Form</li>
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
                            <h3 class="card-title">Add Customer Product Code</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('product-code.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select Product</label>
                                            <select class="custom-select select select2" name="product_id" required>
                                                <option selected value="" disabled>--select--</option>
                                                @foreach ($products as $item)
                                                  <option value="{{$item->id}}">{{$item->title}}({{$item->product_code}})</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select Customer</label>
                                            <select class="custom-select" name="head_customer_id" required>
                                                <option selected value="" disabled>--select--</option>
                                                @foreach ($head_customers as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Customer Code</label>
                                    <input type="text" name="customer_product_code" class="form-control" id="exampleInputEmail1" placeholder="Enter Customer Code">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">GP%</label>
                                    <input type="text" name="gp" class="form-control" id="exampleInputEmail1" placeholder="Enter Product GP">
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
                                <h3 class="card-title">Manage Color information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>product Name</th>
                                        <th>Customer Name</th>
                                        <th>Product Code</th>
                                        <th>GP(%)</th>
                                       <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($code as $item)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$item->products->title}}({{$item->products->product_code ?? ''}})</td>
                                        <td>{{$item->head_customer->name ?? ''}}</td>
                                        <td>{{$item->customer_product_code}}</td>
                                         <td>{{$item->gp}}</td>
                                        
                                     
                                        
                                        <td>
                                           
                                            {{-- <form action="{{route('color.destroy',[$item->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form> --}}


                                            <a href="{{route('product-code.edit',[$item->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
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