<!-- /.card-header -->
<div class="card-body">
    <table id="example1" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>Serial</th>
            {{-- <th>Wear House Name</th> --}}
            <th>Product Title</th>
            <th>Color</th>

            {{-- <th>Product Code</th> --}}
            {{-- <th>Supplier Name</th> --}}
            <th>Supplier Code </th>
            {{-- <th>Product Price</th> --}}
            <th>Quantity</th>
            <th>Ready Quantity</th>
            {{-- <th>Total Cost</th> --}}
            {{-- <th>Total Buying Cost</th> --}}
            {{-- <th>Image</th> --}}
            <th>Status</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody>
        @php $i=1; @endphp
        @foreach($products as $data)
            <tr>
                <td>{{$i}}</td>
                {{-- <td>{{$data->wear_house_name}}</td> --}}
                <td>{{$data->title}}({{$data->product_code}})</td>
                {{-- <td>{{$data->product_code}}</td> --}}
                {{-- <td>{{$data->supllier-}}</td> --}}
                <td>{{$data->color_name}}</td>
                <td>{{$data->supplier_code}}</td>
                {{-- <td>{{$data->product_price ?? ''}}</td> --}}
                <td>{{$data->available_quantity}}</td>
                <td>{{$data->ready_quantity}}</td>
                {{-- <td>{{$data->total_cost}}</td> --}}
                {{-- <td>{{$data->total_buying_cost}}</td> --}}

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


                    {{-- <li><a href="#" type="button" data-id="{{$data->id}}" onClick="open_container(this);" class="btn btn-warning" data-toggle="modal" data-target="#modal-default">Discount</a></li> --}}
                    <a href="#"  style="display: inline;" class="btn btn-success" onclick="ViewPaymentInfo({{$data->id}})"  data-toggle="modal"
                        data-target=".bd-example-modal-lg" title="Product_transfer"><i class="fa fa-eye"></i></a>
                </td>
            </tr>
        @php $i++; @endphp
        @endforeach
    </table>
</div>
<!-- /.card-body -->
