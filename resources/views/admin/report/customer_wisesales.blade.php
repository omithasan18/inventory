@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Order</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
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
                                <div class="row">
                                    {{-- <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select Distributed House</label>
                                            <select class="custom-select" name="status" id="distributed_id">
                                                @foreach ($distributed as $item)
                                                  <option value="{{$item->id}}">{{$item->distributed_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div> --}}
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select Customer</label>
                                            <select class="custom-select" name="status" id="customer_id">
                                                @foreach ($h_customer as $item)
                                                <option value="{{$item->id}}">{{$item->name}}</option>    
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body" id="customerwise-sales">
                                    
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Customer Name</th>
                                            <th>Order Date</th>
                                            <th>Sub Total</th>
                                            <th>GP</th>
                                            <th>Order Total</th>
                                     
                                            {{-- <th>Deu</th> --}}
                                      
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
                                                {{-- <td>{{$data->payment_status}}</td> --}}
                                                {{-- <td>{{$data->pay}}</td> --}}
                                                {{-- <td>{{$data->due}}</td>                                                --}}
                                            
                                                
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
</script>
<script>
    $(document).ready(function(){
            $('#customer_id').on('change', function() {
                var customer_id = $('#customer_id').val();
                // alert(customer_id);
              $.ajax({
                  type: 'post',
                  dataType: 'html',
                  url: '{{url('admin/get-customerwise-sales')}}',
                  data: 'customer_id=' + customer_id,
                  success:function (response) {
                     console.log(response);
                    $('#customerwise-sales').html(response);
                },
              });
            });
        });
</script>
@endsection