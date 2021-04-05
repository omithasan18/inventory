@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Dashboard</title>
@endsection
@section('main-content')
<div class="content-wrapper" style="min-height: 578px;">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <section class="content">
    <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box">
                    <span class="info-box-icon bg-info elevation-1"><i class="far fa-money-bill-alt"></i></span>
                    @php
                    $today_sales =0;
                                        $orders = App\Order::whereDate('created_at', Carbon\Carbon::today())->where('order_status',2)->get();
                                        @endphp
                                        @foreach ($orders as $item)
                                           @php  $today_sales +=$item->total @endphp
                                        @endforeach
                    <div class="info-box-content">
                        <span class="info-box-text">Today Sales</span>
                        <span class="info-box-number">
          {{$today_sales}}
          <small>Tk</small>
        </span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-purple elevation-1"><i class="far fa-money-bill-alt"></i></span>
                    @php
                    $total_sales =0;
                                        $orders = App\Order::where('order_status',2)->get();
                                        @endphp
                                        @foreach ($orders as $item)
                                           @php  $total_sales +=$item->total @endphp
                                        @endforeach
                    <div class="info-box-content">
                        <span class="info-box-text">Total Sales</span>
                        <span class="info-box-number">{{$total_sales}}<small>Tk</small></span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->

            <!-- fix for small devices only -->
            <div class="clearfix hidden-md-up"></div>

            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-success elevation-1"><i class="fas fa-shopping-cart"></i></span>
                    @php
                    $total_order =0;
                                        $orders = App\Order::where('order_status',2)->count();
                                        @endphp
                                        {{-- @foreach ($orders as $item)
                                           @php  $total_order =$item->count() @endphp
                                        @endforeach --}}
                    <div class="info-box-content">
                        <span class="info-box-text">Total Complete Orders</span>
                        <span class="info-box-number">{{$orders}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
            <div class="col-12 col-sm-6 col-md-3">
                <div class="info-box mb-3">
                    <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-users"></i></span>
                    @php
                    $total_customer =0;
                                        $orders = App\Customer::where('status',1)->get();
                                        @endphp
                                        @foreach ($orders as $item)
                                           @php  $total_customer =$item->count() @endphp
                                        @endforeach
                    <div class="info-box-content">
                        <span class="info-box-text">Total Customers</span>
                    <span class="info-box-number">{{$total_customer}}</span>
                    </div>
                    <!-- /.info-box-content -->
                </div>
                <!-- /.info-box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->


        <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <div class="col-md-12">
                        <!-- MAP & BOX PANE -->

                        <!-- /.card -->

                        <!-- /.row -->

                        <!-- TABLE: LATEST ORDERS -->
                        <div class="card">
                            <div class="card-header border-transparent">
                                <h3 class="card-title">Latest Orders</h3>

                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table m-0">
                                        <thead>
                                        <tr>
                                            <th>Customer Name</th>
                                            <th>Order Status</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        @php 
                                        $orders = App\Order::where('order_status','!=',6)->OrderBy('id','desc')->get();
                                            if(Auth::user()->role_id==4){
                                                $orders = App\Order::OrderBy('id','desc')->where('seller_id',Auth::user()->id)->get();
                                            }
                                        @endphp
                                        <tbody>
                                            @if($orders)
                                            @foreach ($orders as $item)
                                            <tr>
                                                <td>{{$item->customer->customer_name ?? ''}}</td>
                                                <td>{{$item->payment_status}}</td>
                                                <td> @php
                                                    if($item->order_status == 1){
                                                            echo  "<div class='badge badge-shadow'>Pending</div>";
                                                        }elseif($item->order_status ==2){
                                                            echo  "<div class='badge badge-shadow'>Complete</div>";
                                                        }else{
                                                            echo  "<div class='badge badge-shadow'>Proccessing</div>";
                                                        }
                                                @endphp</td>
                                                <td>
                                                     @if($item->order_status==2 )
                                                        <a href="{{route('edit-order',[$item->id])}}" class="btn btn-warning"><i class="fa fa-info"></i></a>
                                                        @else
                                                        <a href="{{route('edit-order',[$item->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                        @endif
                                                </td>
                                                
                                            </tr>
                                            @endforeach
                                       @endif
                                        </tbody>
                                    </table>
                                </div>
                                <!-- /.table-responsive -->
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer clearfix">
                                <a href="{{route('pos-product')}}" class="btn btn-sm btn-info float-left">Place New Order</a>
                                <a href="{{route('manage-order')}}" class="btn btn-sm btn-secondary float-right">View All Orders</a>
                            </div>
                            <!-- /.card-footer -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->


                    <!-- /.col -->
                </div>
                <!-- /.row -->
                            </div><!--/. container-fluid -->
        </section>
        <!-- /.content -->
    </div>
@endsection
@section('script')

@endsection
