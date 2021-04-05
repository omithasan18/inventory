<section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          {{-- <div class="callout callout-info">
            <h5><i class="fas fa-info"></i> Note:</h5>
            This page has been enhanced for printing. Click the print button at the bottom of the invoice to test.
          </div> --}}


          <!-- Main content -->
          <div class="invoice p-3 mb-3">
            <!-- title row -->
            <div class="row">
              <div class="col-12">
                <h4>
                  <img src="{{$supplier->image}}" alt="" height="60px" width="60px"> {{$supplier->business_name}}
                  <small class="float-right">Date: {{date('d/m/y')}}</small>
                </h4>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              {{-- <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>Admin, Inc.</strong><br>
                  795 Folsom Ave, Suite 600<br>
                  San Francisco, CA 94107<br>
                  Phone: (804) 123-5432<br>
                  Email: info@almasaeedstudio.com
                </address>
              </div> --}}
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
                To
                <address>
                  <strong>{{$supplier->supplier_name ?? ''}}</strong><br>
                  Phone:  {{$supplier->phone ?? ''}}<br>
                  Email:  {{$supplier->email ?? ''}}<br>
                  Country: {{$supplier->country ?? ''}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-6 invoice-col">
              <b>Last payment: {{$last_pay->pay_amount ?? ''}}</b><br>
                <b>Last Payment Date:</b> {{$last_pay->created_at ?? ''}}<br>
                <b>Paid By :</b> {{$last_pay->payment_method ?? ''}}
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            {{-- <div class="row">
              <div class="col-12 table-responsive">
                <table class="table table-striped">
                  <thead>
                  <tr>
                    <th>Supplier Name</th>
                    <th>Order Date</th>
                    <th>Purchase Total</th>
                  </tr>
                  </thead>
                  <tbody> --}}
                    {{-- @foreach ($orders as $item)
                    <tr>
                      <td>{{$item->customer->customer_name}}</td>
                      <td>{{$item->order_date}}</td>
                      <td>{{$item->sub_total}}</td>
                      <td>{{$item->vat}}</td>
                      <td>{{$item->total}}</td>                     
                    </tr>
                    @endforeach --}}
                 
{{--                 
                  </tbody>
                </table>
              </div> --}}
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-6">
                @php $gross=0; @endphp
                      @foreach ($paid as $data)
                       @php $gross+=$data->total @endphp
                       
                      @endforeach
                      @php $total_paid=0; $total_due=0; @endphp
                      @foreach ($pay_amount as $data)
                       @php $total_paid+=$data->pay_amount @endphp
                       
                      @endforeach
                   @php $total_due=$gross-$total_paid @endphp
              <form action="{{route('save-supplier-payment')}}" method="post">
              @csrf
                <div class="col-md-12">
                  <div class="form-group mb-3">
                      <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Pay Amount<span class="text-danger">*</span> </label>
                      <div class="col-sm-12 col-md-12">
                        <input type="hidden" value="{{$total_due}}" id="num2" class="form-control" autofocus >
                        <input type="hidden" value="{{$supplier->id ?? ''}}" name="supplier_id" class="form-control" autofocus >
                          <input type="text" id="num1" class="form-control" name="pay_amount" autofocus>
                      {{-- <input type="hidden" class="form-control" name="head_customer_id" value="{{$head_customer->id}}" autofocus> --}}
                      </div>
                  </div>
                </div>
                <div class="col-md-12">
                  <div class="form-group mb-3">
                      <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Due Amount <span class="text-danger">*</span> </label>
                      <div class="col-sm-12 col-md-12">
                          <input type="text" id="subt" class="form-control" autofocus name="due" readonly>
                          <input type="hidden" class="form-control" autofocus name="date" value="{{date('d-m-y')}}" readonly>
                      </div>
                  </div>
              </div>
              <div class="col-md-12">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Payment <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                        <select class="custom-select" name="payment_method" required>
                            <option value="Handcash">Hand Cash</option>
                            <option value="Cheque">Cheque</option>
                            <option value="Deu">Deu</option>
                        </select>
                    </div>
                </div>
            </div>
              <button type="submit" class="btn btn-success float-right"><i class="far fa-credit-card"></i> Submit
                Payment
              </button>
            </form>
              </div>
              <!-- /.col -->
              <div class="col-6">
                {{-- <p class="lead">Amount Due : {{$total_due}}</p> --}}

                <div class="table-responsive">
                  <table class="table">
                    <tr>
                      <th style="width:50%">Total Purchase Amount:</th>
                      @php $gross=0; @endphp
                      @foreach ($paid as $data)
                       @php $gross+=$data->total @endphp
                       
                      @endforeach
                    <td>{{$gross}}</td>
                    </tr>
                   
                    <tr>
                      <th>Total paid</th>
                      <td>{{$total_paid}}</td>
                    </tr>
                    <tr>
                      <th>Total Due:</th>
                      <td>{{$total_due}}</td>
                    </tr>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            {{-- <div class="row no-print">
              <div class="col-12">
                <a href="invoice-print.html" target="_blank" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
               
              </div>
            </div> --}}
          </div>
          <!-- /.invoice -->
        </div><!-- /.col -->
      </div><!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
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