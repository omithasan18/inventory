<!-- /.card-header -->
<div class="card-body">
    
    <table id="example" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Serial</th>
            <th>Product Title</th>
            {{-- <th>Product Code</th> --}}
            <th>Supplier Name</th>
            {{-- <th>Supplier Code </th> --}}
            <th>Purchase Price</th>
            <th>Available Quantity</th>
            <th>Total Cost</th>
            <th>Total Buying Cost</th>
            <th>Purchase Price With Cost</th>
            <th>Selling Price</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
        @foreach($products as $data)
            <tr>
                <td>{{$i}}</td>
                <td>{{$data->title}}</td>
                {{-- <td>{{$data->product_code}}</td> --}}
                <td>{{$data->supllier->supplier_name ?? ''}}</td>
                {{-- <td>{{$data->supplier_code}}</td> --}}
                <td>{{$data->purchase_price}}</td>
                <td>{{$data->available_quantity}}</td>
                <td>{{$data->total_cost}}</td>
                <td>{{$data->total_buying_cost}}</td>
                <td>{{$data->total_buying_cost_per_qty}}</td>
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
                    
                </td>
            </tr>
        @php $i++; @endphp
        @endforeach
    </table>

</div>
<!-- /.card-body -->