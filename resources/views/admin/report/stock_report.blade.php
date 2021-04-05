@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Stcok</title>
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
                        <h1>Stock Report </h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Stock Report</li>
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
                                    <h3 class="card-title">Manage Stock Report information</h3>
                                    <br>
                                    <br>
                                    <div class="col-sm-6">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Select Distributed House</label>
                                            <select class="custom-select" name="status" id="distributed_id">
                                                @foreach ($distributed as $item)
                                                  <option value="{{$item->id}}">{{$item->distributed_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                </div>
                                
                                <!-- /.card-header -->
                                <div class="card-body" id="get-stock-report">
                                    
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Product Title</th>
                                            {{-- <th>Product Code</th> --}}
                                            <th>Supplier Name</th>
                                            {{-- <th>Supplier Code </th> --}}
                                            <th>Purchase Price</th>
                                            <th>Available Quantity</th>
                                            <th>Total Cost</th>
                                            <th>Total Buying Cost</th>
                                            <th>Purchase Price With Cost</th>
                                            <th>Selling Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($products as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->title}}</td>
                                                {{-- <td>{{$data->product_code}}</td> --}}
                                                <td>{{$data->supplier_name ?? ''}}</td>
                                                {{-- <td>{{$data->supplier_code}}</td> --}}
                                                <td>{{$data->purchase_price}}</td>
                                                <td>{{$data->available_quantity}}</td>
                                                <td>{{$data->total_cost}}</td>
                                                <td>{{$data->total_buying_cost}}</td>
                                                <td>{{$data->total_buying_cost_per_qty}}</td>
                                                <td>{{$data->selling_price ?? ''}}</td>
                                               
                                            {{-- <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td> --}}
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
                                                    
                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}

                                                    <?php  if($data->status == 1){ ?>
                                                        <a href="{{route('inactive-product',[$data->id])}}"
                                                           class="btn btn-success" title="Inactive"><i
                                                                    class="fa fa-arrow-down"></i></a>
                                                        <?php }else{ ?>
                                                        <a href="{{route('active-product',[$data->id])}}"
                                                           class="btn btn-warning" title="Active"><i
                                                                    class="fa fa-arrow-up"></i></a>
                                                        <?php } ?>
                                                    
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
            $('#distributed_id').on('change', function() {
                var distributed_id = $('#distributed_id').val();
                // alert(distributed_id);
              $.ajax({
                  type: 'post',
                  dataType: 'html',
                  url: '{{url('admin/get-stock-report')}}',
                  data: 'distributed_id=' + distributed_id,
                  success:function (response) {
                     console.log(response);
                    $('#get-stock-report').html(response);
                },
              });
            });
        });
</script>
@endsection