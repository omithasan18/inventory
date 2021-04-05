@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Add Product</title>
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
  
<link href="https://www.jqueryscript.net/css/jquerysctipttop.css" rel="stylesheet" type="text/css">
<link rel="stylesheet" href="https://www.jqueryscript.net/demo/Bootstrap-4-Tag-Input-Plugin-jQuery/tagsinput.css">
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
                        <form role="form" action="{{route('supplier.store')}}" method="post" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Supplier Name <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="hidden" name="admin_id" value="">
                                                    <input type="text" class="form-control" autofocus name="supplier_name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Business Name <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="hidden" name="admin_id" value="">
                                                    <input type="text" class="form-control" autofocus name="business_name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                            
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Pi Number <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" autofocus name="pi_number">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Contact Code <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" autofocus name="contact_code">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Phone Number <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="number" class="form-control" autofocus name="phone">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Email <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="email" class="form-control" autofocus name="email">
                                                </div>
                                            </div>
                                        </div>
                    
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">City </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" autofocus name="city">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">State  </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" autofocus name="state">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Country  </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" autofocus name="country">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Image </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" class="form-control" autofocus name="image">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
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
    

@endsection