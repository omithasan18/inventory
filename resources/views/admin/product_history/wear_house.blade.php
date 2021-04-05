@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Wear House Product</title>
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
                        <h1>Ware House Product</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Ware House Product</li>
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
                                    @php $role_id = Auth::user()->role_id @endphp
                                    @if($role_id!=3)
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <!-- select -->
                                            <div class="form-group">
                                                <label>Select Ware House</label>
                                                <select class="custom-select" id="ware_house_id">
                                                    <option value="" disabled selected>--select--</option>
                                                    @foreach ($warehouse as $item)
                                                    <option value="{{$item->id}}">{{$item->wear_house_name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <h3 class="card-title">Ware House Product information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="get-wearhouseProduct-history">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            @php $role = Auth::user()->role_id @endphp
                                            @if($role==1)
                                            <th>Ware House Name</th>
                                            @endif
                                            <th>Product Title</th>
                                            <th>Color</th>

                                            {{-- <th>Product Code</th> --}}
                                            {{-- <th>Supplier Name</th> --}}
                                            <th>Supplier Code </th>
                                            {{-- <th>Product Price</th> --}}
                                            <th>Total Quantity</th>
                                            <th>UnReady Quantity</th>
                                            <th>Ready Quantity</th>
                                            <th>Transferred Quantity</th>
                                            {{-- <th>Total Buying Cost</th> --}}
                                            {{-- <th>Image</th> --}}
                                            <th>Status</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($products as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                @if($role==1)
                                                <td>{{$data->wear_house_name}}</td>
                                                @endif
                                                <td>{{$data->title}}({{$data->product_code}})</td>
                                                <td>{{$data->color_name ?? ''}}</td>
                                                {{-- <td>{{$data->product_code}}</td> --}}
                                                {{-- <td>{{$data->supllier-}}</td> --}}
                                                <td>{{$data->supplier_code}}</td>
                                                {{-- <td>{{$data->product_price ?? ''}}</td> --}}
                                                <td>{{$data->quantity}}</td>
                                                <td>{{$data->available_quantity}}</td>
                                                <td>{{$data->ready_quantity}}</td>
                                                <td>{{$data->total_transfer}}</td>
                                                {{-- <td>{{$data->total_buying_cost}}</td> --}}

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
                                                {{-- <td> --}}

                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    {{-- <li><a href="#" type="button" data-id="{{$data->id}}" onClick="open_container(this);" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">Discount</a></li> --}}
                                                    {{-- <a href="#"  style="display: inline;" class="btn btn-success" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                                                        data-target=".bd-example-modal-lg" title="Product_transfer"><i class="fa fa-eye"></i></a> --}}
                                                {{-- </td> --}}
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
{{-- product transfer --}}
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
           <div class="modal-header">
               <!-- <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5> -->
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseModelHandler()">
                   <span aria-hidden="true">&times;</span>
               </button>
           </div>
           <div class="modal-body">
               <div id="view-model">


                   Content goes here....

               </div>


           </div>
       </div>
   </div>
</div>
{{-- product transfer --}}

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
            $('#ware_house_id').on('change', function() {
                var ware_house_id = $('#ware_house_id').val();
                // alert(ware_house_id);
              $.ajax({
                  type: 'post',
                  dataType: 'html',
                  url: '{{url('admin/get-wearhouseProduct-history')}}',
                  data: 'ware_house_id=' + ware_house_id,
                  success:function (response) {
                     console.log(response);
                    $('#get-wearhouseProduct-history').html(response);
                },
              });
            });
        });
</script>
<script>
    $(document).ready(function() {
        $('.btn_on').hide();
        $('.dataTables_filter').hide();
        $('#tableExport_info').hide();
        $('#tableExport_paginate').hide();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    });
    var token = $("input[name=_token]").val();
    function ViewPaymentInfo(id) {
        var datastr = "id=" + id + "&token=" + token;
        $.ajax({
            type: "POST",
            url: "<?php echo route('get-wearhouse-product-information'); ?>",
            data: datastr,
            cache: false,
            success: function(data) {
                console.log(data);
                $('#view-model').html(data);
            },
            error: function(jqXHR, status, err) {
//                    alert(status);
                console.log(err);
            },
            complete: function() {
                // alert("Complete");
            }
        });

    }

</script>
@endsection
