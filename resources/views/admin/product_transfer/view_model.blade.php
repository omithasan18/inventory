<form role="form" action="{{route('save-transfer')}}" method="post">
                @csrf
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Product Title <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                <input type="text" id="title" value="{{$main_data->title}}({{$main_data->product_code ?? ''}})" class="form-control" autofocus name="slug" readonly>
                                    <input type="hidden" value="{{$main_data->id}}" id="pro_id" name="product_id" class="form-control" id="exampleInputEmail1" placeholder="" readonly>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Purchase Price <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="number" value="{{$main_data->total_buying_cost_per_qty}}"  id="slug" placeholder="Product Qty" class="form-control" autofocus name="" required readonly> 
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Selling Price <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    <input type="number" value="{{$main_data->selling_price}}"  id="slug" placeholder="Selling Price" class="form-control" autofocus name="selling_price" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Select Ware House <span class="text-danger">*</span> </label>
                                <select class="form-control " style="width: 100%;" name="wear_house_id" required>
                                    @foreach ($data as $item)
                                <option value="{{$item->id}}">{{$item->wear_house_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Available Quantity </label>
                                <div class="col-sm-12 col-md-12">
                                    @foreach ($quantity as $item)
                                    <div class="row">
                                        <div class="col-sm-6" style="margin-bottom: 8px;">
                                            <input type="text" value="{{$item->product_color->color_name}}" placeholder="Product Qty" class="form-control" autofocus name="" required readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" value="{{$item->available_quantity}}" placeholder="Product Qty" class="form-control" autofocus name="" required readonly>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label class="col-form-label text-md-left col-12 col-md-12 col-lg-12">Transfer Quantity <span class="text-danger">*</span> </label>
                                <div class="col-sm-12 col-md-12">
                                    @foreach ($quantity as $item)
                                    <div class="row">
                                        <div class="col-sm-6" style="margin-bottom: 8px;">
                                            <input type="text" value="{{$item->product_color->color_name}}"  id="slug" placeholder="Product Qty" class="form-control" autofocus name="" required readonly>
                                            <input type="hidden" value="{{$item->color_id}}" name="color_id[]"  id="slug" placeholder="Product Qty" class="form-control" required readonly>
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="number" value="0" name="quantity[]" id="quantity" placeholder="Transfer Quantity" class="form-control" autofocus>
                                        </div>
                                    </div>
                                    @endforeach
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