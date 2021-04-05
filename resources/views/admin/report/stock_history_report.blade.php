@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} |Product Stock History</title>
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
                        <h1>Product Stock History</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Stock History</li>
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
                                   
                                    <h3 class="card-title">Product Stock History information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body" id="get-wearhouseProduct-history">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>

                                            <th>Product Title</th>
                                            <th>Color</th>

                                            {{-- <th>Product Code</th> --}}
                                            {{-- <th>Supplier Name</th> --}}
                                            <th>Supplier </th>
                                            
                                            <th>Quantity</th>
                                            <th>Product Price</th>
                                            <th>Total Buying Cost</th>
                                            <th>Date</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($stock_history as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->product_S->title}}({{$data->product_S->product_code}})</td>
                                                <td>{{$data->color->color_name ?? ''}}</td>
                                                {{-- <td>{{$data->product_code}}</td> --}}
                                                <td>{{$data->supplier->supplier_name ?? ''}}</td>
                                                <td>{{$data->quantity}}</td>
                                                <td>{{$data->purchase_price}}</td>
                                                <td>{{$data->total_buying_cost_per_qty}}</td>
                                                <?php $str=$data->created_at;
                                                      $date = explode(' ',$str)
                                                ?>
                                                <td>{{$date[0]}}</td>
                                                
                                               
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
