@extends('admin.layouts.app')
@section('title')
    <title>{{ config('app.name') }} | Assign Role</title>
@endsection
@section('main-content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Assign Role Form</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Assign Role Form</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                
                    <!-- left column -->
                    <div class="col-md-12">
     
                    <section class="content">
                        <div class="box box-primary" >
                                        
                            <div class="box-body">
                                <form method="POST" action="{{route('assign-role.store')}}" accept-charset="UTF-8" id="role_form">
                                    @csrf
                                <div class="row">
                                <div class="col-md-4">
                                  <div class="form-group">
                                    <label for="name">Role Name:*</label>
                                    <select class="custom-select" name="role_id">
                                      @foreach($roles as $role)
                                      {{-- <option value="{{$cat->id}}" @php if ($sub_by_id['cat_id'] == $cat->id) { echo "selected"; } @endphp>{{$cat->cat_title}}</option> --}}
                                      <option value="{{$role->id}}">{{$role->role_name}}</option>
                                      @endforeach
                                    </select>
                                  </div>
                                </div>
                                </div>
                                        <div class="row">
                                <div class="col-md-3">
                                  <label>Permissions:</label> 
                                </div>
                                </div>
                                <div class="row check_group">
                                  <div class="col-md-1">
                                    <h4>Category</h4>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="">
                                        <label>
                                          <input type="checkbox" name="category" value="1" id="categoryall" > Select Category
                                        </label>
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck category" name="view_category" id="checkItem" type="checkbox" value="1"> View Category
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck category" name="add_category" id="checkItem" type="checkbox" value="1"> Add Category
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck category" name="edit_category" type="checkbox" value="1"> Edit Category
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck category" name="delete_category" type="checkbox" value="1"> Delete Category
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <hr>
                                <div class="row check_group">
                                  <div class="col-md-1">
                                    <h4>Brands</h4>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="">
                                        <label>
                                          <input type="checkbox" name="brand" value="1" id="brandall" > Select all
                                        </label>
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck brand" name="view_brand" id="checkItem" type="checkbox" value="1"> View Brand
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck brand" name="add_brand" id="checkItem" type="checkbox" value="1"> Add Brand
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck brand" name="edit_brand" type="checkbox" value="1"> Edit Brand
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck brand" name="delete_brand" type="checkbox" value="1"> Delete Brand
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <hr>
                                  <div class="row check_group">
                                    <div class="col-md-1">
                                      <h4>Product</h4>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="">
                                          <label>
                                            <input type="checkbox" name="product" value="1" id="productall" > Select all
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck product" name="view_product" id="checkItem" type="checkbox" value="1"> View Product
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck product" name="add_product" id="checkItem" type="checkbox" value="1"> Add Product
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck product" name="edit_product" type="checkbox" value="1"> Edit Product
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck product" name="delete_product" type="checkbox" value="1"> Delete Product
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    <hr>
                                <div class="row check_group">
                                <div class="col-md-1">
                                  <h4>User</h4>
                                </div>
                                <div class="col-md-2">
                                    <div class="">
                                      <label>
                                        <input type="checkbox" name="user" value="1" id="select_all" > Select all
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck check" name="view_user" id="checkItem" type="checkbox" value="1"> View user
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck check" name="add_user" id="checkItem" type="checkbox" value="1"> Add user
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck check" name="edit_user" type="checkbox" value="1"> Edit user
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck check" name="delete_user" type="checkbox" value="1"> Delete user
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <hr>
                                <div class="row check_group">
                                  <div class="col-md-1">
                                    <h4>Customer</h4>
                                  </div>
                                  <div class="col-md-2">
                                      <div class="">
                                        <label>
                                          <input type="checkbox" name="customer" value="1" id="vendor_all" > Select all
                                        </label>
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck vendor" name="view_customer" id="checkItem" type="checkbox" value="1"> View Customer
                                        </label>
                                      </div>
                                    </div>
                        
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck vendor" name="edit_customer" type="checkbox" value="1"> Edit Customer
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck vendor" name="delete_customer" type="checkbox" value="1"> Delete Customer
                                        </label>
                                      </div>
                                    </div>
                                  </div>
                                  </div>
                                  <hr>
                                  <div class="row check_group">
                                    <div class="col-md-1">
                                      <h4>Supplier</h4>
                                    </div>
                                    <div class="col-md-2">
                                      <div class="checkbox">
                                          <label>
                                            <input type="checkbox" value="1" name="supplier" id="affiliateall" class="affiliateall input-icheck" > Select all
                                          </label>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck affiliate" name="view_supplier" type="checkbox" value="1"> View Supplier
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck affiliate" name="add_supplier" type="checkbox" value="1"> Add Supplier
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck affiliate" name="edit_supplier" type="checkbox" value="1"> Edit Supplier
                                          </label>
                                        </div>
                                      </div>
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck affiliate" name="delete_supplier" type="checkbox" value="1"> Delete Supplier
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                  <hr>
                                <div class="row check_group">
                                  <div class="col-md-1">
                                    <h4>POS</h4>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="pos" id="order" class="check_all input-icheck" > Select all
                                        </label>
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck orderall" name="view_pos" type="checkbox" value="1"> View POS
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck orderall" name="add_pos" type="checkbox" value="1"> Add POS
                                        </label>
                                      </div>
                                    </div>
                                
                              
                                  </div>
                                  </div>
                                <hr>
                                <div class="row check_group">
                                <div class="col-md-1">
                                  <h4>Setting</h4>
                                </div>
                                <div class="col-md-2">
                                  <div class="checkbox">
                                      <label>
                                        <input type="checkbox" value="1" name="setting" id="settingall" class="check_all input-icheck" > Select all
                                      </label>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck setting" name="view_setting" type="checkbox" value="1"> View Settings
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck setting" name="add_setting" type="checkbox" value="1"> Add Settings
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck setting" name="edit_setting" type="checkbox" value="1"> Edit Settings
                                      </label>
                                    </div>
                                  </div>
                                  <div class="col-md-12">
                                    <div class="checkbox">
                                      <label>
                                        <input class="input-icheck setting" name="delete_setting" type="checkbox" value="1"> Delete Settings
                                      </label>
                                    </div>
                                  </div>
                                </div>
                                </div>
                                <hr>
                                <div class="row check_group">
                                  <div class="col-md-1">
                                    <h4>Ware house Transfer</h4>
                                  </div>
                                  <div class="col-md-2">
                                    <div class="checkbox">
                                        <label>
                                          <input type="checkbox" value="1" name="wearhouse" id="roleall" class="check_all input-icheck" > Select all
                                        </label>
                                      </div>
                                  </div>
                                  <div class="col-md-9">
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck role" name="view_wearhouse" type="checkbox" value="1"> View Warehouse
                                        </label>
                                      </div>
                                    </div>
                                    <div class="col-md-12">
                                      <div class="checkbox">
                                        <label>
                                          <input class="input-icheck role" name="add_transfer" type="checkbox" value="1"> Add Transfer
                                        </label>
                                      </div>
                                    </div>
                    
                                  </div>
                                  </div>
                                  <hr>
                                  <div class="row check_group">
                                    <div class="col-md-1">
                                      <h4>Distributed Transfer</h4>
                                    </div>
                              
                                    <div class="col-md-9">
                                      <div class="col-md-12">
                                        <div class="checkbox">
                                          <label>
                                            <input class="input-icheck" name="distributed_transfer" type="checkbox" value="1"> Distributed Transfer
                                          </label>
                                        </div>
                                      </div>
                                    </div>
                                    </div>
                                    <hr>
                                
                          
                                  </div>
                                </div>
                                  <div class="row">
                                <div class="col-md-12">
                                   <button type="submit" class="btn btn-primary pull-right">Save</button>
                                </div>
                                </div>
                        
                                </form>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </section>
                        <!-- /.content -->
                        
                                        
                    
          
                <!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->

@endsection
@section('script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
  $('#categoryall').on('click',function(){
        if(this.checked){
            $('.category').each(function(){
                this.checked = true;
            });
        }else{
             $('.category').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.category').on('click',function(){
        if($('.category:checked').length == $('.category').length){
            $('#categoryall').prop('checked',true);
        }else{
            $('#categoryall').prop('checked',false);
        }
    });
  $('#brandall').on('click',function(){
        if(this.checked){
            $('.brand').each(function(){
                this.checked = true;
            });
        }else{
             $('.brand').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.brand').on('click',function(){
        if($('.brand:checked').length == $('.brand').length){
            $('#brandall').prop('checked',true);
        }else{
            $('#brandall').prop('checked',false);
        }
    });
    $('#productall').on('click',function(){
        if(this.checked){
            $('.product').each(function(){
                this.checked = true;
            });
        }else{
             $('.product').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.product').on('click',function(){
        if($('.product:checked').length == $('.product').length){
            $('#productall').prop('checked',true);
        }else{
            $('#productall').prop('checked',false);
        }
    });
    $('#select_all').on('click',function(){
        if(this.checked){
            $('.check').each(function(){
                this.checked = true;
            });
        }else{
             $('.check').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.check').on('click',function(){
        if($('.check:checked').length == $('.check').length){
            $('#select_all').prop('checked',true);
        }else{
            $('#select_all').prop('checked',false);
        }
    });
    $('#order').on('click',function(){
        if(this.checked){
            $('.orderall').each(function(){
                this.checked = true;
            });
        }else{
             $('.orderall').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.orderall').on('click',function(){
        if($('.checkall:checked').length == $('.checkall').length){
            $('#select').prop('checked',true);
        }else{
            $('#select').prop('checked',false);
        }
    });
    $('#select').on('click',function(){
        if(this.checked){
            $('.checkall').each(function(){
                this.checked = true;
            });
        }else{
             $('.checkall').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.checkall').on('click',function(){
        if($('.checkall:checked').length == $('.checkall').length){
            $('#select').prop('checked',true);
        }else{
            $('#select').prop('checked',false);
        }
    });
    $('#settingall').on('click',function(){
        if(this.checked){
            $('.setting').each(function(){
                this.checked = true;
            });
        }else{
             $('.setting').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.setting').on('click',function(){
        if($('.setting:checked').length == $('.setting').length){
            $('#settingall').prop('checked',true);
        }else{
            $('#settingall').prop('checked',false);
        }
    });
    $('#roleall').on('click',function(){
        if(this.checked){
            $('.role').each(function(){
                this.checked = true;
            });
        }else{
             $('.role').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.role').on('click',function(){
        if($('.role:checked').length == $('.role').length){
            $('#roleall').prop('checked',true);
        }else{
            $('#roleall').prop('checked',false);
        }
    });
    $('#vendor_all').on('click',function(){
        if(this.checked){
            $('.vendor').each(function(){
                this.checked = true;
            });
        }else{
             $('.vendor').each(function(){
                this.checked = false;
            });
        }
    });
    $('.vendor').on('click',function(){
        if($('.vendor:checked').length == $('.vendor').length){
            $('#vendor_all').prop('checked',true);
        }else{
            $('#vendor_all').prop('checked',false);
        }
    });
    $('#affiliateall').on('click',function(){
        if(this.checked){
            $('.affiliate').each(function(){
                this.checked = true;
            });
        }else{
             $('.affiliate').each(function(){
                this.checked = false;
            });
        }
    });
    
    $('.affiliate').on('click',function(){
        if($('.affiliate:checked').length == $('.affiliate').length){
            $('#affiliateall').prop('checked',true);
        }else{
            $('#affiliateall').prop('checked',false);
        }
    });
});
</script>
@endsection