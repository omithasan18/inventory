@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Edit User</title>
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
                        <h1>User Management Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    {{-- <div class="col-md-6">
                        <div class="form-group mb-3">
                            <div class="col-sm-12 col-md-12">
                                <div class="form-group">
                                    <label>Select User Type</label>
                                    <select class="custom-select" name="user_type" id="user_type">
                                        <option value="">----select----</option>
                                        <option value="1">Wear House</option>
                                        <option value="2">Distributed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
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
                                <h3 class="card-title">Add User</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->
                            <form action="{{route('user.update',$user_by_id->id)}}" method="post" enctype="multipart/form-data">
                                @method('patch')
                                @csrf
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Name <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="hidden" name="admin_id" value="">
                                                <input type="text" value="{{$user_by_id->name}}" class="form-control" autofocus name="name">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Phone Number <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" value="{{$user_by_id->phone}}" class="form-control" autofocus name="phone">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Email <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" value="{{$user_by_id->email}}"  autofocus name="email">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        @if($user_by_id->role_id==3)
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Ware House Location <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control " style="width: 100%;" name="location_id">
                                                    <option value="" selected="" disabled="">----Select Ware House Location----</option>}
                                                    @foreach ($wear_house as $item)
                                                       <option value="{{$item->id}}" @php if ($user_by_id['location_id'] == $item->id) { echo "selected"; } @endphp>{{$item->location}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        @if($user_by_id->role_id==4)
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Distributed <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control " style="width: 100%;" name="location_id">
                                                    <option value="" selected="" disabled="">----Select distributed Location----</option>}
                                                    @foreach ($distributed as $item)
                                                      <option value="{{$item->id}}" @php if ($user_by_id['location_id'] == $item->id) { echo "selected"; } @endphp>{{$item->location}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        @endif
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Role <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <select class="form-control " style="width: 100%;" name="role_id">
                                                    <option value="" selected="" disabled="">----Select Role----</option>}
                                                    @foreach ($role as $item)
                                                <option value="{{$item->id}}" @php if ($user_by_id['role_id'] == $item->id) { echo "selected"; } @endphp>{{$item->role_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">User Designation <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" value="{{$user_by_id->designation}}" autofocus name="designation">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Address <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="text" class="form-control" value="{{$user_by_id->address}}" autofocus name="address">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12"> Password <span class="text-danger">*</span> </label>
                                                {{--<label>Publication Status</label>--}}
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="password" class="form-control" autofocus name="password">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Image <span class="text-danger">*</span> </label>
                                                <div class="col-sm-12 col-md-12">
                                                    <input type="file" class="form-control" autofocus name="image">
                                                </div>
                                            </div>
                                        </div>
                                        
                                    </div>
         
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <div class="col-sm-12 col-md-12">
                                                    <div class="form-group">
                                                        <label>Publication Status</label>
                                                        <select class="custom-select" name="status">
                                                            <option value="1" @php if ($user_by_id['status'] == 0) { echo "selected"; } @endphp>Active</option>
                                                            <option value="0" @php if ($user_by_id['status'] == 0) { echo "selected"; } @endphp>Inactive</option>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    $(document).ready(function(){
      $('#user_type').on('change',function(){
         var type = $('#user_type').val();
        if(type==1){
            $("#wearhouse").show();
        }else{
            $("#wearhouse").hide();
        }
        if(type==2){
            $("#distributed").show();
        }else{
            $("#distributed").hide();
        }
           
        //  });
      });
    });
</script>