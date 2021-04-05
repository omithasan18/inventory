@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Report</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-md-6">
                        <h1>Manage Report</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Report</li>
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
                                    <br>
                                    <form action="{{route('filter-annual-sales')}}" method="get">
                                        @csrf
                                    <div class="form-group row">

                                    <div class="col-md-4">
                                            <label>Customer Name</label>

                                             <select class="custom-select" name="customer_id">
                                                  <option value="">All</option>
                                                @foreach ($customer as $item)
                                                  <option value="{{$item->id}}" @php echo request()->input('customer_id')==$item->id?'selected':'' @endphp>{{$item->customer_name}}({{$item->head_customer->name ?? ''}})</option>
                                                @endforeach
                                            </select>
                                        </div>

                                <div class="card-footer" style="margin-top: 17px;">
                                    <button type="submit" class="btn btn-primary">Filter</button>
                                </div>
                            </form>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Product Name</th>
                                            {{-- <th>Customer Name</th> --}}
                                            <th>Sales Quantity</th>
                                            <th>Unit Cost</th>
                                            <th>Total</th>
                                            {{-- <th>Order Date</th>
                                            <th>Sub Total</th>
                                            <th>Vat</th>
                                            <th>Order Total</th>
                                            <th>Payment Status</th>
                                            <th>Pay</th>
                                            <th>Deu</th>
                                            <th>Order Status</th>
                                            <th>Action</th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $j=1; @endphp
                                        @foreach($products as $data)
                                            <tr>
                                                <td>{{$j}}</td>
                                                <td>{{$data->product_S->title ?? ''}}</td>
                                                {{-- <td>{{$data->customer_name}}</td> --}}
                                                @php
                                                $balance= DB::table('order_details')
                                                    ->join('orders', 'order_details.order_id', '=', 'orders.id')
                                                    ->where('orders.order_status',2)
                                                    ->where(['product_id'=> $data->product_S->id ?? ''])
                                                    ->where('order_details.created_at', '>=', $date)->sum('quantity')
                                                @endphp
                                                <td>{{$balance}}</td>
                                                <td>{{$data->product_s->selling_price ?? ''}}</td>
                                                @php $total = $balance*$data->product_s->selling_price ?? '' @endphp
                                                <td>{{$total}}</td>

                                                {{-- <td>{{$data->order_date}}</td> --}}
                                                {{-- <td>{{$data->sub_total ?? ''}}</td> --}}
                                                {{-- <td>{{$data->supplier_code}}</td> --}}

                                                {{-- <td>{{$data->vat}}</td>
                                                <td>{{$data->total}}</td>
                                                <td>{{$data->payment_status}}</td>
                                                <td>{{$data->pay}}</td>
                                                <td>{{$data->due}}</td>                                                --}}
                                            {{-- <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td> --}}


                                            </tr>
                                        @php $j++; @endphp
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
