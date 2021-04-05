@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage POS</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid" style="height: 50px">
                <div class="row mb-2" >
                    <div class="col-md-6" style="background-color: burlywood">
                        <h1>POS(Point Of sale)</h1>
                    </div>
                    <div class="col-md-6" style="background-color: burlywood">
                        <ol class="breadcrumb float-sm-right">
                            {{-- <li class="breadcrumb-item"><a href="#">Home</a></li> --}}
                            <div style="text-align:center;padding:1em 0;"> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=en&size=small&timezone=Asia%2FDhaka" width="100%" height="90" frameborder="0" seamless></iframe> </div>
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
                    <div class="col-md-6">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">All Products</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Product Title</th>
                                            <th>Color</th>
                                            {{-- <th>Product Code</th> --}}
                                            {{-- <th>Product Code</th> --}}
                                            {{-- <th>Supplier Name</th> --}}
                                            {{-- <th>Supplier Code </th> --}}
                                            {{-- <th>Product Price</th> --}}
                                            <th>Qty</th>
                                            <th>Price</th>
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
                                                <td>{{$data->title}}({{$data->product_code}})</td>
                                                <td>{{$data->color_name ?? ''}}</td>
                                                {{-- <td>{{$data->product_code}}</td> --}}
                                                {{-- <td>{{$data->supllier-}}</td> --}}
                                                {{-- <td>{{$data->supplier_code}}</td> --}}
                                                {{-- <td>{{$data->product_price ?? ''}}</td> --}}
                                                <td>{{$data->available_quantity}}</td>
                                                <td>{{$data->selling_price}}</td>
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
                                                <form action="{{route('add-to-cart')}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{$data->id}}" name="id">
                                                    <input type="hidden" value="{{$data->title}}" name="name">
                                                    <input type="hidden" value="{{$data->selling_price}}" name="price">
                                                    <input type="hidden" value="{{$data->color_name}}" name="color_name">
                                                    <input type="hidden" value="1" name="qty">
                                                        <button type="submit" style="display: inline;" class="btn btn-success" 
                                                            data-target=".bd-example-modal-lg" title="Add to Cart"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                                                    </form>
                                                    
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
                    <div class="col-md-6">
                        @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        <div class="row">
                            <div class="col-sm-10">
                                <!-- select -->
                                <div class="form-group">
                                    <label>Select Customer</label>
                                    <select class="custom-select" name="status" id="customer" required>
                                        <option value="">---select---</option>
                                        @foreach ($customer as $item)
                                    <option value="{{$item->id}}">{{$item->customer_name ?? ''}}</option>
                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <button type="submit" style="display: inline; margin-top: 31px;" class="btn btn-success" data-toggle="modal"
                                                            data-target=".bd-example-modal-lg" title="Add Customer"><i class="fa fa-plus-circle" aria-hidden="true"></i></button>
                            
                            </div>
                            
                        </div>
                        <!-- general form elements -->
                        <div class="col-12 table-responsive" style="background-color: floralwhite">
                            <table class="table table-striped">
                              <thead>
                              <tr>
                                {{-- <th>Serial #</th> --}}
                                <th>Title</th>
                                <th>Color</th>
                                <th>Qty</th>
                                <th>Unit Price</th>
                                <th>Subtotal</th>
                                <th>Action</th>
                              </tr>
                              </thead>
                              @php $i=1; @endphp
                             @php $product = Cart::getContent(); @endphp
                              <tbody>
                                  @foreach($product as $item)
                              <tr>
                              {{-- <td>{{$i}}</td> --}}
                                <td>{{$item->name ?? ''}}({{$item->attributes->product_code ?? ''}})</td>
                                <td>{{$item->attributes->color_name ?? ''}}</td>
                              <form action="{{route('cart-update')}}" method="post">
                                @csrf
                                <td style="width: 150px"><input type="number" min="1" value="{{$item->quantity}}" style="width: 90px; float:left" name="quantity[]">
                                    <input type="hidden" min="1" value="{{$item->id}}" style="width: 40px; float:left" name="id[]">
                                </td>
                               
                               
                               
                                <td>{{$item->price}}</td>
                                <td>{{$item->price*$item->quantity}}</td>
                                <td>
                                <a href="{{URL::to('admin/cart-remove/'.$item->id)}}" class="btn btn-danger"><i class="fa fa-trash"></i></a></td>
                              </tr>
                              @php $i++; @endphp
                              @endforeach
                              </tbody>
                            </table>
                            <button type="submit" class="btn btn-sm btn-success" style="float: right; margin-bottom: 5px">Update cart</button>
                          
                        </form>
                            <div class="table-responsive" style="background-color: darkkhaki">
                                <table class="table">
                                  <!--<tr>-->
                                  <!--  <th style="width:50%">Subtotal:</th>-->
                                  <!--  <td>{{$subTotal = Cart::getSubTotal()}}TK</td>-->
                                  <!--</tr>-->
                                  {{-- <tr>
                                    <th>Tax (15%)</th>
                                    <td>{{$tax = ($subTotal*15)/100}}TK</td>
                                  </tr> --}}
                                  {{-- <tr>
                                    <th>Shipping:</th>
                                    <td>$5.80</td>
                                  </tr> --}}
                                  <tr>
                                    <th>Total:</th>
                                    <td>{{$subTotal}}Tk</td>
                                  </tr>
                                </table>
                              </div>
                          </div>
                        <form action="{{route('create-sale-online')}}" method="post">
                            @csrf
                            <div class="row" style="margin-top: 6px">
                                <label class="col-form-label">Discount type <span class="text-danger">*</span> </label>
                            <select name="discount_type" id="">
                            <option value="1">Flat</option>    
                            <option value="0">Percentage</option>    
                            </select><br>
                            <label class="col-form-label">Discount<span class="text-danger">*</span> </label>
                        <input type="text" name="discount" required  style="width: 44%"><br>
                            </div>
                            <div class="row" style="margin: 5px">
                                <label class="col-form-label">PO Number <span class="text-danger">*</span> </label>
                            <input type="text" name="pio_number" value="{{old('pio_number')}}" required style="width: 79%">
                            </div>
                            <div class="row">
                                <label class="col-form-label">PO Date <span class="text-danger">*</span> </label>
                                <input type="date" name="pio_date" value="{{old('pio_date')}}" required style="width: 25%">
                                <label class="col-form-label">Delivery Date <span class="text-danger">*</span> </label>
                                <input type="date" name="delivery_date" value="{{old('delivery_date')}}" required style="width: 38%">
                            </div>
                            <div class="row" style="margin: 5px">
                                <label class="col-form-label">Shipping Charge <span class="text-danger">*</span> </label>
                                <input type="text" name="shipping" value="{{old('shipping')}}" required style="width: 73%">
                            </div>
                            
                            <input type="hidden" id="customer_id" name="customer_id" required>
                            <button type="submit" class="btn btn-lg btn-warning" style="margin-top: 20px;
                            margin-left: 252px;">Create Sale</button>
                          </form>
                          
                    </div>
                    
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
                   

                <div class="card-header">
                    <h3 class="card-title">Add Customer</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
            <form role="form" action="{{route('pos-customer-product')}}" id="customerForm" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Child Customer Name <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="hidden" name="admin_id" value="">
                                        <input type="text" class="form-control" autofocus name="customer_name">
                                    </div>
                                </div>
                            </div>
                           
        
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Email Address <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="text" class="form-control" autofocus name="email">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Phone Number <span class="text-danger">*</span> </label>
                                    <div class="col-sm-12 col-md-12">
                                        <input type="number" class="form-control" autofocus name="phone">
                                    </div>
                                </div>
                            </div>
                        </div>
                      
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Address </label>
                                    <div class="col-sm-12 col-md-12">
                                        <textarea type="text" class="form-control" autofocus name="address"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group mb-3">
                                    <div class="col-sm-12 col-md-12">
                                        <div class="form-group">
                                            <label>Publication Status</label>
                                            <select class="custom-select" name="status">
                                                <option value="1">Active</option>
                                                <option value="0">Inactive</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>

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
<script>
    $(document).ready(function(){
        $('#customer').on('change', function() {
            var customer_id = $('#customer').val();
            $('#customer_id').val(customer_id);
        });
    });
</script>
{{-- <script>
    $(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('#customerForm').submit(function(e){
            e.preventDefault();
            // $('#modal').modal('hide');
            var data = $(this).serialize();
            var url = '{{url('admin/pos-customer-product')}}'
            
            $.ajax({
                url:url,
                method:'post',
                data:data,
                success:function(response){
                    $('#modal').modal('hide');
                    document.getElementById("customerForm").reset();
                    console.log(response)
                },
                error:function(error){
                    console.log(error)
                },
            })
        })
    });
</script> --}}
@endsection