@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Supplier</title>
    <meta name="csrf-token" content="{{csrf_token()}}">
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Manage Supplier Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Manage Supplier Form</li>
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
                                    <h3 class="card-title">Manage Supplier information</h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                        <tr>
                                            <th>Serial</th>
                                            <th>Supplier Name</th>
                                            <th>Business Name</th>
                                            {{-- <th>Pi Number</th> --}}
                                            <th>Contact Code</th>
                                            <th>Email </th>
                                            <th>Phone</th>
                                            <th>Image</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=1; @endphp
                                        @foreach($datas as $data)
                                            <tr>
                                                <td>{{$i}}</td>
                                                <td>{{$data->supplier_name}}</td>
                                                <td>{{$data->business_name}}</td>
                                                {{-- <td>{{$data->pi_number}}</td> --}}
                                                <td>{{$data->contact_code}}</td>
                                                <td>{{$data->email}}</td>
                                                <td>{{$data->phone}}</td>
                                            <td><img src="{{asset($data->image)}}" height="50px" width="50px"></td>
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
                                                    <?php  if($data->status == 1){ ?>
                                                    <a href="{{route('inactive-supplier',[$data->id])}}"
                                                       class="btn-sm btn-success" title="Inactive"><i
                                                                class="fa fa-arrow-down"></i></a>
                                                    <?php }else{ ?>
                                                    <a href="{{route('active-supplier',[$data->id])}}"
                                                       class="btn-sm btn-warning" title="Active"><i
                                                                class="fa fa-arrow-up"></i></a>
                                                    <?php } ?>
                                                    {{-- <form action="{{route('brand.destroy',[$data->id])}}" method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                                    </form> --}}


                                                    <a href="{{route('supplier.edit',[$data->id])}}" class="btn-sm btn-info"><i class="fa fa-edit"></i></a>
                                                    <a href="#"  style="display: inline;" class="btn-sm btn-primary" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                                                        data-target=".bd-example-modal-lg"><i class="fa fa-eye"></i></a>
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
{{-- model --}}
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
    var token = $("input[name=_token]").val();
    function ViewPaymentInfo(id) {
        var datastr = "id=" + id + "&token=" + token;
        $.ajax({
            type: "POST",
            url: "<?php echo route('get-supplier-information'); ?>",
            data: datastr,
            cache: false,
            success: function(data) {
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