@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Edit Product</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
    <style>
        .select2-container .select2-selection--single{
            height: 39px !important;
        }

        body { background-color:#fafafa;}
        .container { margin: 150px auto; }
        h2 { margin:20px auto; font-size:14px;}
        .badge { margin: 2px 5px; }

    </style>



 <!-- Stylesheet -->


@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Product Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Product Form</li>
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
                    <div class="col-md-12">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="card-header">
                                <h3 class="card-title">Add Product</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('product.update',$product_by_id->id)}}" method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="hidden" name="admin_id" value="">
                                                <input type="text" value="{{$product_by_id->title}}" class="form-control" autofocus name="title">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Code <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="hidden" name="admin_id" value="">
                                                    <input type="text" value="{{$product_by_id->product_code}}" class="form-control" autofocus name="product_code">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Unit <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <select class="form-control" style="width: 100%;" name="product_unit">
                                                        <option value="" selected="" disabled="">----Select Unit----</option>}

                                                    <option value="1" @php if ($product_by_id['product_unit'] == 1) { echo "selected"; } @endphp>Pc</option>
                                                    <option value="2" @php if ($product_by_id['product_unit'] == 2) { echo "selected"; } @endphp>Packet</option>

                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Category <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control select2" style="width: 100%;" name="category_id">
                                                    <option value="" selected="" disabled="">----Select Category----</option>}
                                                    @foreach ($categories as $item)
                                                     <option value="{{$item->id}}" @php if ($product_by_id['category_id'] == $item->id) { echo "selected"; } @endphp>{{$item->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Brand <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control select2" style="width: 100%;" name="brand_id">
                                                    <option value="" selected="" disabled="">----Select Brand----</option>}
                                                    @foreach ($brands as $item)
                                                      <option value="{{$item->id}}" @php if ($product_by_id['brand_id'] == $item->id) { echo "selected"; } @endphp>{{$item->brand_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Purchase Price <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" value="{{$product_by_id->purchase_price}}" class="form-control" autofocus name="purchase_price">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Supplier Name <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control select2" style="width: 100%;" name="supplier_id">
                                                    <option value="" selected="" disabled="">----Select Supplier----</option>}
                                                    @foreach ($supplier as $item)
                                                <option value="{{$item->id}}" @php if ($product_by_id['supplier_id'] == $item->id) { echo "selected"; } @endphp>{{$item->supplier_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Supplier Product Code <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" value="{{$product_by_id->supplier_code}}" class="form-control" autofocus name="supplier_code">
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    
                                    <div class="col-md-12">
                                        <div class="form-group mb-3">
                                            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Details </label>
                                            <div class="col-sm-12 col-md-12">
                                                <textarea class="form-control" name="description" id="summary-ckeditor" name="summary-ckeditor">{{$product_by_id->description}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <label for="inputEmail3" class="col-form-label">Product Cost</label>
                                            <table class="table table-striped" id="productImage">
                                                <thead>
                                                </thead>
                                                <tbody>
                                                    @if(count($cost_type)>0)

                                                    @foreach ($cost_type as $cost)

                                                        <tr>
                                                            <td><input type="text" class="form-control" value="{{$cost->cost_type}}" name="cost_type[]" placeholder="Cost Title"></td>
                                                    <td><input type="number" class="form-control" value="{{$cost->cost_amount}}" name="cost_amount[]" placeholder="Cost Amount"></td>
                                                    <td> <button id="add"  type="button" class="btn btn-success add"><i class="fa fa-plus-circle"></i> </button></td>

                                                        </tr>
                                                    @endforeach
                                                    @else
                                                    <tr>
                                                    <td><input type="text" class="form-control" name="cost_type[]" placeholder="Cost Title"></td>
                                                    <td><input type="number" class="form-control" name="cost_amount[]" placeholder="Cost Amount"></td>
                                                    <td> <button id="add"  type="button" class="btn btn-success add"><i class="fa fa-plus-circle"></i> </button></td>
                                                </tr>
                                                @endif

                                                <tr></tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Feature Image <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" class="form-control" autofocus name="feture_img">
                                                </div>
                                            </div>
                                        </div> --}}
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Image <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" class="form-control" autofocus name="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group mb-3">
                                            <img src="{{asset($product_by_id->image)}}" alt="" height="50px" width="50px">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group mb-3">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Publication Status</label>
                                                        <select class="custom-select" name="status">
                                                            <option value="1" @php if ($product_by_id['status'] == 1) { echo "selected"; } @endphp>Active</option>
                                                            <option value="0" @php if ($product_by_id['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
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
                        <!-- /.card -->

                    </div>
                    <!--/.col (left) -->
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
    </script>
    <script type="text/javascript">
        $( document ).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $(document).on('click', '.add', function(){
                var html = '';
                html += '<tr>';
                html += '<td><input type="text" name="cost_type[]" class="form-control" placeholder="Cost Title" required/></td><td><input type="number" name="cost_amount[]" class="form-control" placeholder="Cost Amount" required/></td>';
                html += '<td><button type="button" name="remove" class="btn btn-danger btn-sm remove"><span class="fa fa-minus-circle"></span></button></td></tr>';
                $('#productImage').append(html);
            });

            $(document).on('click', '.remove', function(){
                $(this).closest('tr').remove();
            });
        });
    </script>
@endsection
