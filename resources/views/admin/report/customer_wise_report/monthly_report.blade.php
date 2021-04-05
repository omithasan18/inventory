@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Order</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1>Manage Order Form</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Order Form</li>
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
                                    <h3 class="card-title">Manage Order information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Sub Total</th>
                                            <th>GP</th>
                                            <th>Order Total</th>
                                            <th>Payment Status</th>
                                            <th>Pay</th>
                                            <th>Deu</th>
                                            <th>Order Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($orders as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->customer->customer_name ?? ''}}</td>
                                                {{-- <td>{{$data->product_code}}</td> --}}
                                                <td>{{$data->order_date}}</td>
                                                <td>{{$data->sub_total ?? ''}}</td>
                                                {{-- <td>{{$data->supplier_code}}</td> --}}
                                                
                                                <td>{{$data->vat}}</td>
                                                <td>{{$data->total}}</td>
                                                <td>{{$data->payment_status}}</td>
                                                <td>{{$data->pay}}</td>
                                                <td>{{$data->due}}</td>                                               
                                            {{-- <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td> --}}
                                                <td>
                                                    @php
                                                        if($data->order_status == 1){
                                                                echo  "<div class='badge badge-shadow'>Pending</div>";
                                                            }elseif($data->order_status ==2){
                                                                echo  "<div class='badge badge-shadow'>Complete</div>";
                                                            }else{
                                                                echo  "<div class='badge badge-shadow'>Proccessing</div>";
                                                            }
                                                    @endphp
                                                </td>
                                                <td>
                                                    
                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}

                                                       @if($data->order_status==2 )
                                                        <a href="{{route('edit-order',[$data->id])}}" class="btn btn-warning"><i class="fa fa-info"></i></a>
                                                        @else
                                                        <a href="{{route('edit-order',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        @endif

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