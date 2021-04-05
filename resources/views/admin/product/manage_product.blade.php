@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Product</title>
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
                        <h1>Manage Product Form</h1>
                    </div>
                    <div class="col-md-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Product Form</li>
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
                                    <h3 class="card-title">Manage Category information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Product Title</th>
                                            {{-- <th>Current ColorWise Quantity</th> --}}
                                            <th>Supplier Name</th>
                                            {{-- <th>Supplier Code </th> --}}
                                            @php $role = Auth::user()->role_id @endphp
                                            @if($role==1)
                                            <th>Purchase Price</th>
                                            @endif
                                            {{-- <th>Current Add Quantity</th> --}}
                                            <th>Available Quantity</th>
                                            {{-- <th>Total Cost Per Quantity</th> --}}
                                            {{-- <th>Product Total Buying Cost</th> --}}
                                            @if($role==1)
                                            <th>Purchase Price With Cost</th>
                                            @endif
                                            <th>Selling Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $k=1; @endphp
                                        @foreach($products as $data)
                                            <tr>
                                                <td>{{$k}}</td>
                                                <td>{{$data->title}}({{$data->product_code}})</td>
                                                {{-- <td>@php
                                                    $i=1;
                                                   $count =  count($data->product_color);
                                                   @endphp
                                                   @foreach ($data->product_color as $item)
                                                       {{$item->product_color->color_name ?? ''}}-{{$item->quantity ?? ''}}
                                                           @if($i != $count)
                                                               ,
                                                           @endif
                                                       @php $i++; @endphp
                                                   @endforeach</td> --}}
                                                <td>{{$data->supllier->supplier_name ?? ''}}</td>
                                                {{-- <td>{{$data->supplier_code}}</td> --}}
                                                @if($role==1)
                                                <td>{{$data->purchase_price}}</td>
                                                @endif
                                                {{-- <td>{{$data->quantity}}</td> --}}
                                         
                                                    <td>@php
                                                        $i=1;
                                                       $count =  count($data->product_color);
                                                       @endphp
                                                       @foreach ($data->product_color as $item)
                                                           {{$item->product_color->color_name ?? ''}}-{{$item->available_quantity ?? ''}}
                                                               @if($i != $count)
                                                                   ,
                                                               @endif
                                                           @php $i++; @endphp
                                                       @endforeach</td>
                                                
                                                
                                                {{-- <td>{{$data->total_cost}}</td> --}}
                                                {{-- <td>{{$data->total_buying_cost}}</td> --}}
                                                @if($role==1)
                                                <td>{{$data->total_buying_cost_per_qty}}</td>
                                                @endif
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
                                                    <ul class="nav navbar-nav">

                                                        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Action<span class="caret"></span></a>
                                                          <ul class="dropdown-menu" style="margin-left: -92px">
                                                            <li><a style="display: block; padding: 3px 20px; clear: both;font-weight: 400;line-height: 1.42857143;color: #333;white-space: nowrap;" href="{{route('product.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a></li>
                                                            <li><a style="display: block; padding: 3px 20px; clear: both;font-weight: 400;line-height: 1.42857143;color: #333;white-space: nowrap;" href="#"  style="display: inline;" class="btn btn-success" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                                                                data-target=".bd-example-modal-lg" title="Product_transfer">Reduce Stock</a></li>
                                                            <li><a style="display: block; padding: 3px 20px; clear: both;font-weight: 400;line-height: 1.42857143;color: #333;white-space: nowrap;" href="{{route('add-product-stock',[$data->id])}}" type="button" class="btn btn-warning">Add Stock</a></li>
                                                            {{-- @if($role->delete_product == 1) --}}
                                                            <li><a href="#" class="btn btn-danger" style="display: block; padding:0px 20px; clear: both;font-weight: 400;line-height: 1.42857143;color: #333;white-space: nowrap;">
                                                                <form action="{{route('product.destroy',[$data->id])}}" method="post">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <button type="submit" onclick="return confirm('Are You Sure ?')" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                                </form>
                                                            </li>
                                                        </a>
                                                            {{-- @endif --}}
                                                          </ul>
                                                        </li>
                                                      </ul>
                                                </td>
                                            </tr>
                                        @php $k++; @endphp
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
{{-- Add Stock --}}
      <!-- /.content-wrapper -->
      <div class="modal fade" id="modal-default1">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
                <span>Add Stock</span>
            </div>
            <div class="modal-body">
            <form role="form" action="{{route('update-quantity')}}" method="post">
                    @csrf
                    <div class="col-md-12">
                        {{-- <div class="form-group mb-3">
                            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Supplier Name<span class="text-danger">*</span> </label>
                            <select class="custom-select" name="status">
                                <option value="" disabled>---select---</option>
                                @foreach ($supplier as $item)
                                <option value="{{$item->id}}">{{$item->supplier_name}}</option>

                                @endforeach

                            </select>
                        </div> --}}
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="title" class="form-control" autofocus name="slug" readonly>
                                    <input type="text" id="peoduct_code" class="form-control" autofocus name="slug" readonly>
                                    <input type="hidden" id="pro_id" name="product_id" class="form-control" id="exampleInputEmail1" placeholder="">
                                    <input type="text" name="admin_id" value="{{Session::get('adminId')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Reduce Quantity <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="slug" placeholder="Product Qty" class="form-control" autofocus name="quantity" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Reason <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <textarea type="text" placeholder="Reason why U Reduced !!" class="form-control" autofocus name="reason"></textarea>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Selling Price <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="text" id="selling_price" placeholder="Selling price" class="form-control" autofocus name="selling_price">
                                </div>
                            </div>
                        </div> --}}
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>
      {{-- end add stock --}}
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
{{-- <script type="text/javascript">
    function open_container(id,slug)
    {
        $.ajax({
            url:'{{ url('admin/get-product-discount-information') }}',
            type: 'GET',
            dataType: 'JSON',
            data: { id:id.getAttribute('data-id') },
            success: function(data){
                    $('#product_price').val(data.product_price);
                    $('#product_id').val(data.id);
                    $('#r_product_id').val(slug);
                    $('#s_product_id').val(slug);
                    $('#discount_type').val(data.discount_type);
                    // $('#modal-default').modal('show');
                    // $("#r_product_id").html("<input type='text' value='data.id+ class='form-control'>");
            }
        });
    }
</script> --}}
<script type="text/javascript">
    function open_container_view(id)
    {
        $.ajax({
            url:'{{ url('admin/get-product-discount-information') }}',
            type: 'GET',
            dataType: 'JSON',
            data: { id:id.getAttribute('data-id') },
            success: function(data){
                console.log(data.id);
                    $('#title').val(data.title);
                    $('#pro_id').val(data.id);
                    $('#purchase_price').val(data.purchase_price);
                    $('#selling_price').val(data.selling_price);
                    $('#product_code').val(data.product_code);
                    // $('#modal-default').modal('show');
                    // $("#r_product_id").html("<input type='text' value='data.id+ class='form-control'>");
            }
        });
    }

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
            url: "<?php echo route('get-reduce-product-information'); ?>",
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
