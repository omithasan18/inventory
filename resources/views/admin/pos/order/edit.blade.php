@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Manage Invoice</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Invoice</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Invoice</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="callout callout-info">
              <h5><i class="fas fa-info"></i> Note:</h5>
              This page has been enhanced for printing. Click the print button at the bottom of the invoice.
            </div>


            <!-- Main content -->
            <div class="invoice p-3 mb-3" id="printableArea">
              <!-- title row -->
              @php $shop = App\ShopAddress::first() @endphp
              <div class="row">
                <div class="col-12">
                  <h4>
                    <img src="{{$shop->image ?? ''}}" alt="" height="100px" width="200px" style="margin-left: 440px;">

                    <small class="float-right">Date: {{date('d/m/y')}}</small>
                    <h2 style="text-align: center">INVOICE</h2>
                  </h4>
                </div>
                <!-- /.col -->
              </div>
              <!-- info row -->

              <div class="row invoice-info">
                <div class="col-sm-12 invoice-col">
                  {{-- From --}}
                  <address>
                    <strong>{{$shop->name ?? ''}}.</strong>,
                    {{$shop->address1 ?? ''}}
                    {{$shop->address2 ?? ''}}
                    Phone: {{$shop->phone ?? ''}},
                    Email: {{$shop->email ?? ''}}
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">

                  <address>
                    <strong>PO Number</strong>:
                  {{$order->pio_number ?? ''}}
                  </address>
                </div>
                <div class="col-sm-2 invoice-col">

                  <address>
                    <strong>PO Date</strong>:
                  {{$order->pio_date ?? ''}}
                  </address>
                </div>
                 <div class="col-sm-4 invoice-col">

                  <address style="
    font-size: 20px;
">
                    <strong>Delivery Date</strong>:
                  {{$order->delivery_date ?? ''}}
                  </address>
                </div>
                <div class="col-sm-3 invoice-col">

                  <address>

                  </address>
                </div>
                <div class="col-sm-3 invoice-col">

                  <address>
                    <strong>Invoice Number</strong>:
                    {{$order->invoice_number ?? ''}}
                  </address>
                </div>
                <div class="col-sm-2 invoice-col">

                  <address>
                    <strong>Invoice Date</strong>:
                    {{$order->invoice_date ?? ''}}
                  </address>
                </div>

                <div class="col-sm-12 invoice-col">
                  <!--To-->
                  <address><strong>{{$order->head_customer->name ?? ''}}</strong><br>
                    <strong>{{$customer->customer_name ?? ''}}</strong>,
                  {{-- {{$customer->customer_name}}<br> --}}
                    Phone: {{$customer->phone ?? ''}},
                    Email: {{$customer->email ?? ''}},
                    Address: {{$customer->address ?? ''}}
                  </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-4 invoice-col">
                  {{-- <b>Invoice #007612</b><br> --}}
                  <br>

                  {{-- @php $order = App\Order::first() @endphp --}}
                  {{-- <b>Order Date: {{$order->order_date ?? ''}}</b> <br>
                  <b>Order Number: {{$order->id}}</b> <br>
                  <b>Invoice Number: {{$order->id}}</b><br>
                  <b>Delivery Date: {{$order->delivery_date ?? ''}}</b>  --}}
                  {{-- @if($order)
                  @php  $order++ @endphp
                  @else
                  @php  1 @endphp
                  @endif --}}
                   <br>
                  {{-- <b>Payment Due:</b> 2/22/2014<br> --}}

                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- Table row -->
              <div class="row">
                <div class="col-12 table-responsive">
                  <table class="table table-striped" style="border: 1px solid black;">
                    <thead style="border: 1px solid black;">
                                            <tr>
                            <th style="border: 1px solid black;">Sl #</th>
                            <th style="border: 1px solid black; width: 50px; font-size: 14px">C. Product Code</th>
                            <th style="border: 1px solid black; text-align:center">Product Title</th>
                            <th style="border: 1px solid black; width: 15px;">Qty</th>
                            <th style="border: 1px solid black;">MRP/PC OR PACK TAKA</th>

                            <!--<th>Unit Price</th>-->

                            <th style="border: 1px solid black;">GP%</th>
                            <th style="border: 1px solid black;">TP/Discount Rate</th>
                            {{-- <th>Subtotal</th> --}}
                            {{-- <th>Total TP</th> --}}
                            <th style="border: 1px solid black;">Total Value</th>
                          </tr>
                          </thead>
                          @php $i=1; @endphp
                          @php $total_cost=0;
                          $total_v=0;
                          @endphp
                          <tbody style="border: 1px solid black;">
                            @foreach($content as $item)
                            <tr style="border: 1px solid black;">
                                  <td style="border: 1px solid black;">{{$i}}</td>
                                  @if(!empty($item->customer_code))
                                  <td style="border: 1px solid black; text-align:center">{{$item->customer_code ?? ''}}</td>
                                  @else
                                    <td style="border: 1px solid black; text-align:center" >{{0}}</td>
                                  @endif
                                  <td style="border: 1px solid black; ">{{$item->product_S->title ?? ''}}({{$item->product_S->product_code?? ''}})</td>
                                  
                                  @php 
                              $balance = App\OrderDetails::where(['order_id'=>$order->id,'product_id'=> $item->product_S->id])->sum('quantity');
                               @endphp
                                  <td style="width: 15px; border: 1px solid black; text-align:center">{{$balance}}</td>
                                  <td style="border: 1px solid black; text-align:center">{{$item->product_S->selling_price}}</td>
    
                                  <!--<td>{{$item->unit_cost}}</td>-->
    
                                  @if(!empty($item->gp))
                                  <td style="border: 1px solid black; text-align:center">{{$gp = $item->gp ?? ''}}</td>
                                  @else
                                     <td style="border: 1px solid black; text-align:center">{{$gp = 0}}</td>
                                  @endif
                                  @php $total_tp_rate = $item->product_S->selling_price*$gp/100 @endphp
                                  <td style="border: 1px solid black; text-align:center">{{$tp_value = $item->product_S->selling_price-$total_tp_rate}}</td>
                                  @php $total = $tp_value*$balance @endphp
                                  @php $cost = $balance*$total_tp_rate @endphp
                                  @php
                                   $total_cost +=$cost;
                                  @endphp
                                  <td style="border: 1px solid black; text-align:center">{{$total}}</td>
                                  @php
                                   $total_v +=$total;
                                  @endphp
                                </tr>
                                @php $i++; @endphp
                                @endforeach
    
                        </tbody>
                    <tfoot>
                      <th></th>
                      <th></th>
                      <th></th>
                      <!--<th></th>-->
                      <th></th>
                      <th></th>
                      <th style="border: 1px solid black;">Total</th>
                      <th></th>
                    @php $total_cost @endphp
                    <th style="border: 1px solid black; text-align:center">{{$total_v}}</th>
                    </tfoot>
                  </table>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <div class="row">
                <!-- accepted payments column -->
                <div class="col-6">
                  {{-- <p class="lead">Payment Methods:</p> --}}
                  {{-- <img src="../../dist/img/credit/visa.png" alt="Visa">
                  <img src="../../dist/img/credit/mastercard.png" alt="Mastercard">
                  <img src="../../dist/img/credit/american-express.png" alt="American Express">
                  <img src="../../dist/img/credit/paypal2.png" alt="Paypal"> --}}
                  <p>
                    <b>Payment By: </b>{{$order->payment_status}}<br>
                    <b>Paid Amount : </b>{{$order->pay}}<br>
                    <b>Due Amount : </b>{{$order->due}}<br>
                  </p>
                  <b>In Words</b> : @php echo strtoupper(NumConvert::word($order->total)); @endphp TAKA
                </div>
                <!-- /.col -->
                <div class="col-6">
                  {{-- <p class="lead">Amount Due 2/22/2014</p> --}}

                  <div class="table-responsive">
                    <table class="table">
                        <tr>
                        <th style="width:50%">Discount :</th>
                        <td>
                        @php $dis_amount=0; @endphp
                        @php
                          $dis_amount = $order->discount_amount
                        @endphp
                        {{$dis_amount}}

                         TK
                        </td>


                      </tr>
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{$grand_total=($total_v-$dis_amount)}}TK</td>
                      </tr>
                      <tr>
                          @php $shipping = 0; @endphp
                      <th>Shipping Charge</th>
                        <td>{{$shipping = $order->shipping ?? ''}}TK</td>
                      </tr>
                      {{-- <tr>
                        <th>Shipping:</th>
                        <td>$5.80</td>
                      </tr> --}}
                      <tr>
                        <th>Grand Total:</th>
                        <td>{{($word=$grand_total+$shipping)}}Tk</td>
                      </tr>
                    </table>

                  </div>
                </div>
                 <div class="col-12">
                  <p class="text-muted well well-sm shadow-none" style="margin-top: 10px; margin-left:179px">
                    <b>Terms:</b>***This is a system generated document. No signature is required***

                  </p>
                </p>
                <p>Yours Sincerely</p>
                <P>----------------------</P>
                <p style="margin-top: -17px;">{{Auth::user()->name}}</p>
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->

              <!-- this row will not appear when printing -->
              <div class="row no-print">
                <div class="col-12">
                    <a href="#" onclick="printDiv()" class="btn btn-default"><i class="fas fa-print"></i> Print</a>
                    @if($order->order_status != 2)
                  <button type="button" class="btn btn-success float-right" data-toggle="modal"
                  data-target=".bd-example-modal-lg"><i class="far fa-credit-card"></i>
                    Confirm
                  </button>
                  @endif
                </div>
              </div>
            </div>
            <!-- /.invoice -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
    <!-- /.content-wrapper -->
{{-- payable --}}
<div class="modal fade bd-example-modal-lg" id="modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
   <div class="modal-dialog modal-lg">
       <div class="modal-content">
           <div class="modal-header">
               <!-- <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5> -->
               <button type="button" class="close" data-dismiss="modal" aria-label="Close" onclick="CloseModelHandler()">
               <span aria-hidden="true">Invoice of {{$customer->customer_name ?? ''}}</span><br>
               {{-- <span aria-hidden="true">Total Amount {{$total_v+$shipping}}</span> --}}
               </button>
           </div>
           <div class="modal-body">
               <div id="view-model">

               <form action="{{route('final-order')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Customer Name <span class="text-danger">*</span> </label>
                            <div class="col-sm-12 col-md-12">
                                {{-- <input type="number" class="form-control" id="subt" autofocus name="due"> --}}
                                <input type="text" class="form-control" value="{{$customer->customer_name ?? ''}}"  autofocus name="customer_id">
                                <input type="hidden" class="form-control" value="{{$order->id}}"  autofocus name="order_id">
                                <input type="hidden" class="form-control" value="{{$customer->id ?? ''}}"  autofocus name="customer_id">
                            {{-- <input type="hidden" class="form-control" value="{{date('d/m/y')}}" autofocus name="order_date"> --}}
                            {{-- <input type="hidden" class="form-control" value="{{$subTotal}}" autofocus name="sub_total"> --}}
                                {{-- <input type="hidden" class="form-control" value="{{$tax}}" autofocus name="vat"> --}}
                                {{-- <input type="hidden" class="form-control" value="{{$subTotal+$tax}}" autofocus name="total"> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Status <span class="text-danger">*</span> </label>
                            <div class="col-sm-12 col-md-12">
                                <select class="custom-select" name="order_status" required>
                                  <option value="1">Pending</option>
                                  <option value="2">Delivered</option>
                                  <!--<option value="3">Returned</option>-->
                                  <!--<option value="4">Refund</option>-->
                                  <!--<option value="5">Replaced</option>-->
                                  <option value="6">Canceled</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary float-right" style="margin-right: 5px;">
                        Submit
                      </button>
                </div>
            </form>
               </div>


           </div>
       </div>
   </div>
</div>
@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
    function printDiv(){
        var printContents = document.getElementById("printableArea").innerHTML;
        var originalContents = document.body.innerHTML;
        document.body.innerHTML = printContents;
        window.print();
        document.body.innerHTML = originalContents;
        $("div").removeClass("show");
        location.reload();
    }
</script>
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
