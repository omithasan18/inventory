<form role="form" action="{{route('reduce-quantity')}}" method="post">
    @csrf
    <div class="col-md-12">
        {{-- <div class="form-group mb-3">
            <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Supplier Name<span class="text-danger">*</span> </label>
            <select class="custom-select" name="status">
                <option value="" disabled>---select---</option>
                @foreach ($supplier as $item)
                <option value="{{$item->id}}">{{$item->supplier_name}}</option>

                @endforeach

            </select>
        </div> --}}
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                <div class="col-sm-12 col-md-12">
                <input type="text" value="{{$data->title}}({{{$data->product_code}}})" class="form-control" autofocus name="slug" readonly>
                <input type="hidden" value="{{$data->id}}" class="form-control" autofocus name="product_id" readonly>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Reduce Quantity <span class="text-danger">*</span> </label>
                <div class="col-sm-12 col-md-12">
                    @foreach ($quantity as $item)
                    <div class="row">
                        <div class="col-md-6" style="margin-bottom: 5px">
                            <input type="text" value="{{$item->product_color->color_name ?? ''}}" placeholder="Product Qty" class="form-control" autofocus name="" required readonly>
                        </div>
                        <div class="col-md-6">
                            <input type="number" placeholder="Product Qty" class="form-control" autofocus name="quantity[]" required>
                            <input type="hidden" value="{{$item->color_id}}" placeholder="Product Qty" class="form-control" autofocus name="color_id[]" required>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-12">
            <div class="form-group mb-3">
                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Reason <span class="text-danger">*</span> </label>
                <div class="col-sm-12 col-md-12">
                    <textarea type="text" placeholder="Reason why U Reduced !!" class="form-control" autofocus name="reason"></textarea>
                </div>
            </div>
        </div>
        {{-- <div class="col-md-6">
            <div class="form-group mb-3">
                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Selling Price <span class="text-danger">*</span> </label>
                <div class="col-sm-12 col-md-12">
                    <input type="text" id="selling_price" placeholder="Selling price" class="form-control" autofocus name="selling_price">
                </div>
            </div>
        </div> --}}
    </div>
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Save</button>
    </div>
</form>
