@extends('admin.layouts.app')
@section('title')
<title>{{ config('app.name') }} | Manage Supplier Purchase</title>
@endsection
@section('main-content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>add Purchase</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Purchase Form</li>
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
                <div class="col-md-4">
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
                            <h3 class="card-title">Add Purchase</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                    <form role="form" action="{{route('supplier-purchase.store')}}" method="post">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Suppilier Name</label>
                                            <select class="custom-select" name="supplier_id">
                                                @foreach ($supplier as $item)
                                                  <option value="{{$item->id}}">{{$item->supplier_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pi number</label>
                                    <input type="hidden" class="form-control" autofocus name="date" value="{{date('d-m-y')}}" readonly>
                                    <input type="text" name="pi_number" class="form-control" id="exampleInputEmail1" placeholder="Pi Number">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Purchase Total</label>
                                    <input type="text" id="num2" name="total" class="form-control" id="exampleInputEmail1" placeholder="Total Amount">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pay Amount</label>
                                    <input type="text" id="num1" name="pay_amount" class="form-control" id="exampleInputEmail1" placeholder="pay">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Due Amount</label>
                                    <input type="text" id="subt" name="due" class="form-control" id="exampleInputEmail1" placeholder="due">
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- select -->
                                        <div class="form-group">
                                            <label>Payment</label>
                                            <select class="custom-select" name="payment_method">
                                                <option value="HandCash">Hand Cash</option>
                                                <option value="Cheque">Cheque</option>
                                                <option value="Due">Due</option>
                                            </select>
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
                <!-- right column -->
                <div class="col-md-8">
                    <!-- general form elements disabled -->
                    <div class="card card-warning">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Manage Color information</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="example1" class="table table-bordered table-striped">
                                    <thead>
                                    <tr>
                                        <th>Serial</th>
                                        <th>Supplier Name</th>
                                        <th>Pi Number</th>
                                        <th>Purchase Total</th>
                                        <th>Pay</th>
                                        <th>Due</th>
                                        <th>Payment Method</th>
                                        <th>Date</th>
                                        {{-- <th>Action</th> --}}
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php $i=1; @endphp
                                    @foreach($supplier_pay as $data)
                                    <tr>
                                        <td>{{$i}}</td>
                                        <td>{{$data->supllier->supplier_name ?? ''}}</td>
                                        <td>{{$data->pi_number}}</td>
                                        <td>{{$data->total}}</td>
                                        <td>{{$data->pay_amount}}</td>
                                        <td>{{$data->due}}</td>
                                        <td>{{$data->payment_method}}</td>
                                        <td>{{$data->date}}</td>
                        
                                        {{-- <td> --}}
                                           
                                            {{-- <form action="{{route('color.destroy',[$data->id])}}" method="post">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                            </form> --}}


                                            {{-- <a href="{{route('supplier-purchase.edit',[$data->id])}}" class="btn btn-info"><i class="fa fa-edit"></i></a> --}}
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

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
    //this calculates values automatically 
    sum();
    $("#num1, #num2").on("keydown keyup", function() {
        sum();
    });
});

function sum() {
            var num1 = document.getElementById('num1').value;
            var num2 = document.getElementById('num2').value;
			var result = parseInt(num1) + parseInt(num2);
			var result1 = parseInt(num2) - parseInt(num1);
            if (!isNaN(result)) {
                // document.getElementById('sum').value = result;
				document.getElementById('subt').value = result1;
            }
        }
</script>
@endsection