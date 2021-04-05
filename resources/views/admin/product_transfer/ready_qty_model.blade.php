<form role="form" action="{{route('save-ready-quantity')}}" method="post">
    @csrf
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                    <input type="text" id="title" value="{{$main_data->title ?? ''}}" class="form-control" autofocus name="slug" readonly>
                        <input type="hidden" value="{{$main_data->product_id ?? ''}}" id="pro_id" name="product_id" class="form-control" id="exampleInputEmail1" placeholder="">
                        <input type="hidden" value="{{$main_data->color_id ?? ''}}" name="color_id" class="form-control" id="exampleInputEmail1" placeholder="">
                        
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Available Quantity <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                        <input type="number" value="{{$main_data->available_quantity}}"  id="slug" placeholder="Product Qty" class="form-control" autofocus required>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group mb-3">
                    <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Ready Quantity <span class="text-danger">*</span> </label>
                    <div class="col-sm-12 col-md-12">
                        <input type="number" name="quantity" id="quantity" placeholder="Transfer Quantity" class="form-control" autofocus>
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