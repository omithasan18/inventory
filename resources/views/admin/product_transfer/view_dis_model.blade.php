<form role="form" action="{{route('distributed-transfer-product')}}" method="post">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                    <input type="text" id="title" value="{{$main_data->title ?? ''}}({{$main_data->product_code ?? ''}})" class="form-control" autofocus name="slug" readonly>
                        <input type="hidden" value="{{$main_data->product_id ?? ''}}" id="pro_id" name="product_id" class="form-control" id="exampleInputEmail1" placeholder="">
                        <input type="hidden" value="{{$main_data->color_id ?? ''}}"  name="color_id" class="form-control" id="exampleInputEmail1" placeholder="">

                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Ready Quantity <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                        <input type="number" value="{{$main_data->ready_quantity}}"  id="slug" placeholder="Product Qty" class="form-control" autofocus readonly>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Select Distributed <span class="text-danger">*</span> </label>
                    <select class="form-control " style="width: 100%;" name="distributed_id" required>
                        <option value="" selected="" disabled="">----Select Distributed----</option>}
                        @foreach ($data as $item)
                    <option value="{{$item->id}}">{{$item->distributed_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Transfer Quantity <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                        <input type="number" value="0" name="quantity" id="quantity" placeholder="Transfer Quantity" class="form-control" autofocus>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-body -->

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
