@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Transfer</title>
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
                        <h1>Manage Transfer</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Transfer</li>
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
                                    <h3 class="card-title">Manage Transfer information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Product Title</th>
                                            {{-- <th>Color </th> --}}
                                            {{-- <th>Supplier Name</th> --}}
                                            <th>Color </th>
                                            {{-- <th>Product Price</th> --}}
                                            <th>Quantity</th>
                                            <th>Ready Quantity</th>
                                            <th>Transferred Quantity</th>
                                            {{-- <th>Total Cost</th> --}}
                                            {{-- <th>Total Buying Cost</th> --}}
                                            {{-- <th>Image</th> --}}
                                            {{-- <th>Status</th> --}}
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($products as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->product->title}}({{$data->product->product_code}})</td>
                                                <td>{{$data->color->color_name ?? ''}}</td>
                                                {{-- <td>{{$data->supllier-}}</td> --}}
                                                {{-- <td>{{$data->supplier_code}}</td> --}}
                                                {{-- <td>{{$data->product_price ?? ''}}</td> --}}
                                                <td>{{$data->available_quantity}}</td>
                                                <td>{{$data->ready_quantity}}</td>
                                                <td>{{$data->total_transfer}}</td>
                                                {{-- <td>{{$data->total_cost}}</td> --}}
                                                {{-- <td>{{$data->total_buying_cost}}</td> --}}

                                            {{-- <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td> --}}
                                                {{-- <td>
                                                    @php
                                                        if($data->status == 1){
                                                                echo  "<div class='badge badge-success badge-shadow'>Active</div>";
                                                            }else{
                                                                echo  "<div class='badge badge-danger badge-shadow'>Inactive</div>";
                                                            }
                                                    @endphp
                                                </td> --}}
                                                <td>

                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    {{-- <li><a href="#" type="button" data-id="{{$data->id}}" onClick="open_container(this);" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">Discount</a></li> --}}
                                                    <a href="#"  style="display: inline;" class="btn btn-sm btn-success" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                                                        data-target=".bd-example-modal-lg" title="Product_transfer"><i class="fas fa-paper-plane"></i></a>
                                                        <a href="#"  style="display: inline;" class="btn btn-sm btn-warning" onclick="ReadyQuantity({{$data->id}})"  data-toggle="modal"
                                                            data-target=".bd-example-modal-lg" title="Add Ready Quantity"><i class="fas fa-eye"></i></a>
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
{{-- Ready Quantity --}}
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
               <div id="view-model-id">


                   Content goes here....

               </div>


           </div>
       </div>
   </div>
</div>
{{-- Ready Quantity --}}

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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
    function ReadyQuantity(id) {
        var datastr = "id=" + id + "&token=" + token;
        $.ajax({
            type: "POST",
            url: "<?php echo route('get-product-qty-information'); ?>",
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
