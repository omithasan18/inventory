 <!-- /.card-header -->
 <div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Serial</th>
           
            <th>Customer Name</th>
            <th>Order date</th>
            <th>Total Product</th>
            <th>Sub Total</th>
            <th>GP</th>
            <th>Order Total</th>
            
        </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
        @foreach($orders as $order)
            <tr>
                <td>{{$i}}</td>
                <td>{{$order->customer_name}}</td>
                <td>{{$order->order_date}}</td>
                <td>{{$order->total_products}}</td>
                <td>{{$order->sub_total}}</td>
                <td>{{$order->vat}}</td>
                <td>{{$order->total}}</td>
                
            </tr>
            @php $i++; @endphp
        @endforeach
        </tbody>
    </table>
</div>
<!-- /.card-body -->