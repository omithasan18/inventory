<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      @php $data = App\User::where('id',Auth::user()->id)->first() @endphp
      <div class="image">
        <img src="{{$data->image ?? ''}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
      <a href="#" class="d-block">{{Auth::user()->name}} </a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item has-treeview menu-open">
          <a href="#" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>
              Dashboard

            </p>
          </a>
        </li>
        @php $role_id = Auth::user()->role_id;
                @endphp
                @php

                $role = \App\AssignRole::where('role_id',$role_id)->first(); @endphp
                @if($role)
                @if($role->pos ==1)
                <li class="nav-item">
                  <a href="{{route('pos-customer-product')}}" class="nav-link">
                    <i class="fas fa-shopping-basket"></i>
                      <p>
                        POS
                      </p>
                    </a>
                  </li>
        <li class="nav-item">
          <a href="{{route('pos-product')}}" class="nav-link">
            <i class="fas fa-cart-arrow-down" style="color: orangered"></i>
              <p>
                Sales Department
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('manage-order')}}" class="nav-link">
              <i class="fas fa-cart-plus" style="color: lightgreen"></i>
                <p>
                  Order
                </p>
              </a>
            </li>
          @endif
          @if($role->category ==1)
          <li class="nav-item has-treeview
          {{ request()->is('admin/category*') ? 'menu-open' : '' }}
          ">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Category
                <i class="fas fa-angle-left right"></i>
                <span class="badge badge-info right">1</span>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('category.create')}}" class="nav-link {{ (request()->is('admin/category*')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Category</p>
                </a>
              </li>
              {{-- <li class="nav-item">
                <a href="{{route('category.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Category</p>
                </a>
              </li> --}}
            </ul>
          </li>
          @endif
          @if($role->brand ==1)
        <li class="nav-item">
          <a href="{{route('brand.create')}}" class="nav-link {{ (request()->is('admin/brand*')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Manage Brand
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{route('color.create')}}" class="nav-link {{ (request()->is('admin/color*')) ? 'active' : '' }}">
              <i class="fas fa-palette"></i>
                <p>
                  Manage Color
                </p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('shop-address.create')}}" class="nav-link">
                <i class="fas fa-store-alt" style="color: turquoise"></i>
                  <p>
                    Manage Shop Address
                  </p>
                </a>
              </li>
          @endif

          @if($role->add_product ==1 || $role->view_product ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/product/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/product') ? 'menu-open' : '' }}
        {{ request()->is('admin/product-code*') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="fab fa-product-hunt"></i>
            <p>
              Product
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">3</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            @if($role->add_product ==1)
            <li class="nav-item">
              <a href="{{route('product.create')}}" class="nav-link {{ (request()->is('admin/product/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Product</p>
              </a>
            </li>
            @endif
            @if($role->view_product ==1)
            <li class="nav-item">
              <a href="{{route('product.index')}}" class="nav-link {{ (request()->is('admin/product')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Product</p>
              </a>
            </li>
            @endif
            {{-- @if($role->view_product ==1)
            <li class="nav-item">
              <a href="{{route('product-index')}}" class="nav-link {{ (request()->is('admin/product')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Product</p>
              </a>
            </li>
            @endif --}}
            @if($role->add_product ==1)
            <li class="nav-item">
              <a href="{{route('product-code.create')}}" class="nav-link {{ (request()->is('admin/product-code*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer Product Code</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if($role->user ==1 || $role->wearhouse==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/wearhouse-transfer') ? 'menu-open' : '' }}
        {{ request()->is('admin/distributed-transfer') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="far fa-share-square"></i>
            <p>
              Transfer Product
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>

          <ul class="nav nav-treeview">
            @if($role->user ==1 )
            <li class="nav-item">
              <a href="{{route('wearhouse-transfer')}}" class="nav-link {{ (request()->is('admin/wearhouse-transfer')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Ware House Transfer</p>
              </a>
            </li>
            @endif
            @if($role->wearhouse ==1 )
            <li class="nav-item">
              <a href="{{route('distributed-transfer')}}" class="nav-link {{ (request()->is('admin/distributed-transfer')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Distribute Transfer</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if($role->wearhouse ==1 || $role->distributed_transfer==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/wearhouse-product') ? 'menu-open' : '' }}
        {{ request()->is('admin/distributed-product') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
               Inventory
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          @if($role->wearhouse ==1 )
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('wearhouse-product')}}" class="nav-link {{ (request()->is('admin/wearhouse-product')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Ware House Product</p>
              </a>
            </li>
            @endif
            @if($role->distributed_transfer ==1 )
            <li class="nav-item">
              <a href="{{route('distributed-product')}}" class="nav-link {{ (request()->is('admin/distributed-product')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Distribute Product</p>
              </a>
            </li>
            @endif
          </ul>
        </li>
        @endif
        @if(Auth::user()->role_id==4)
        <li class="nav-item">
          <a href="{{route('distributed-products')}}" class="nav-link {{ (request()->is('admin/distributed-product')) ? 'active' : '' }}">
            <i class="far fa-circle nav-icon"></i>
            <p>Distribute Product</p>
          </a>
        </li>
        @endif
        @if($role->user ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/user/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/user') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="fas fa-user-plus"></i>
            <p>
              User Manage
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">2</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('user.create')}}" class="nav-link {{ (request()->is('admin/user/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add User</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{route('user.index')}}" class="nav-link {{ (request()->is('admin/user')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage user</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if($role->supplier ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/supplier/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/supplier') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="fas fa-user-tie"></i>
            <p>
              Supplier
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">3</span>
            </p>
          </a>

          <ul class="nav nav-treeview">
            <li class="nav-item">
            <a href="{{route('supplier.create')}}" class="nav-link {{ (request()->is('admin/supplier/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Supplier</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{route('supplier.index')}}" class="nav-link {{ (request()->is('admin/supplier')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Supplier</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('supplier-purchase.create')}}" class="nav-link {{ (request()->is('supplier-purchase.create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Purchase</p>
                </a>
              </li>
          </ul>
        </li>
        @endif
        @if($role->customer ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/head-customer*') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer*') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer') ? 'menu-open' : '' }}
        {{ request()->is('admin/online-customer') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="fas fa-users" style="color: greenyellow"></i>
            <p>
              Customer
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">3</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('head-customer.create')}}" class="nav-link {{ (request()->is('admin/head-customer*')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                  <p>
                    Head Customer
                  </p>
                </a>
              </li>
            <li class="nav-item">
            <a href="{{route('customer.create')}}" class="nav-link {{ (request()->is('admin/customer/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Add Customer</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{route('customer.index')}}" class="nav-link {{ (request()->is('admin/customer')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Customer</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('online-customer')}}" class="nav-link {{ (request()->is('admin/online-customer')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Online Customer</p>
                </a>
              </li>
          </ul>
        </li>
        @endif
        @if($role->setting ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/wear-house/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/distributed/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/role/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/assign-role/create') ? 'menu-open' : '' }}
        {{ request()->is('admin/assign-role') ? 'menu-open' : '' }}
        ">
          <a href="#" class="nav-link">
            <i class="fas fa-users-cog"></i>
            <p>
              User Management
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">5</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
            <li class="nav-item">
              <a href="{{route('wear-house.create')}}" class="nav-link {{ (request()->is('admin/wear-house/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                  <p>
                    Manage Ware House
                  </p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('distributed.create')}}" class="nav-link {{ (request()->is('admin/distributed/create')) ? 'active' : '' }}">
                  <i class="far fa-circle nav-icon"></i>
                    <p>
                      Manage Distributed
                    </p>
                  </a>
                </li>
            <li class="nav-item">
              <a href="{{route('role.create')}}" class="nav-link {{ (request()->is('admin/role/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                  <p>
                    Manage Role
                  </p>
                </a>
              </li>
            <li class="nav-item">
            <a href="{{route('assign-role.create')}}" class="nav-link {{ (request()->is('admin/assign-role/create')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Assign Role</p>
              </a>
            </li>
            <li class="nav-item">
            <a href="{{route('assign-role.index')}}" class="nav-link {{ (request()->is('admin/assign-role')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Manage Assign Role</p>
              </a>
            </li>
          </ul>
        </li>
        @endif
        @if($role->user ==1)
        <li class="nav-item has-treeview
        {{ request()->is('admin/customer-daily-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer-weekly-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer-monthly-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer-annual-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/stock-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/products-daily-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/products-weekly-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/products-monthly-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/products-annual-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/reduce-report') ? 'menu-open' : '' }}
        {{ request()->is('admin/customer-payment') ? 'menu-open' : '' }}
        {{ request()->is('admin/stock-history') ? 'menu-open' : '' }}



        ">
          <a href="#" class="nav-link">
            <i class="nav-icon fas fa-copy"></i>
            <p>
              Report
              <i class="fas fa-angle-left right"></i>
              <span class="badge badge-info right">6</span>
            </p>
          </a>
          <ul class="nav nav-treeview">
              <li class="nav-item has-treeview
              {{ request()->is('admin/customer-daily-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/customer-weekly-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/customer-monthly-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/customer-annual-report') ? 'menu-open' : '' }}

              ">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    CustomerWise Sales Report
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">4</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('customer-daily-report')}}" class="nav-link {{ (request()->is('admin/customer-daily-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daily</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customer-weekly-report')}}" class="nav-link {{ (request()->is('admin/customer-weekly-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Weekly</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customer-monthly-report')}}" class="nav-link {{ (request()->is('admin/customer-monthly-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Monthly</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('customer-annual-report')}}" class="nav-link  {{ (request()->is('admin/customer-annual-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Annual</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item has-treeview
              {{ request()->is('admin/products-daily-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/products-weekly-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/products-monthly-report') ? 'menu-open' : '' }}
              {{ request()->is('admin/products-annual-report') ? 'menu-open' : '' }}
              ">
                <a href="#" class="nav-link">
                  <i class="nav-icon fas fa-copy"></i>
                  <p>
                    ProductWise Sales Report
                    <i class="fas fa-angle-left right"></i>
                    <span class="badge badge-info right">4</span>
                  </p>
                </a>
                <ul class="nav nav-treeview">
                  <li class="nav-item">
                    <a href="{{route('products-daily-report')}}" class="nav-link {{ (request()->is('admin/products-daily-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Daily</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('products-weekly-report')}}" class="nav-link {{ (request()->is('admin/products-weekly-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Weekly</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('products-monthly-report')}}" class="nav-link {{ (request()->is('admin/products-monthly-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Monthly</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('products-annual-report')}}" class="nav-link {{ (request()->is('admin/products-annual-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Annual</p>
                    </a>
                  </li>
                  <li class="nav-item">
                    <a href="{{route('date-range-report')}}" class="nav-link {{ (request()->is('admin/products-annual-report')) ? 'active' : '' }}">
                      <i class="far fa-circle nav-icon"></i>
                      <p>Date Range Report</p>
                    </a>
                  </li>
                </ul>
              </li>
              <li class="nav-item">
                <a href="{{route('customer-wise-sales')}}" class="nav-link">
                  <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                    <p>
                      Sales Report
                    </p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="{{route('stock-history')}}" class="nav-link {{ (request()->is('admin/stock-history')) ? 'active' : '' }}">
                    <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                      <p>
                        Stock History
                      </p>
                    </a>
                  </li>
            {{-- <li class="nav-item">
            <a href="{{route('stock-report')}}" class="nav-link {{ (request()->is('admin/stock-report')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
                <p>Stock Report</p>
              </a>
            </li> --}}
            {{-- <li class="nav-item">
            <a href="{{route('reduce-report')}}" class="nav-link {{ (request()->is('admin/reduce-report')) ? 'active' : '' }}">
              <i class="nav-icon fas fa-copy"></i>
                <p>Reduced Report</p>
              </a>
            </li> --}}
            <li class="nav-item">
            <a href="{{route('customer-payment')}}" class="nav-link {{ (request()->is('admin/customer-payment')) ? 'active' : '' }}">
                <i class="far fa-circle nav-icon"></i>
                <p>Customer Payment Report</p>
              </a>
            </li>
            {{-- <li class="nav-item">
            <a href="{{route('customer.index')}}" class="nav-link ">
                <i class="far fa-circle nav-icon"></i>
                <p>Payment Report</p>
              </a>
            </li>
            <li class="nav-item">
              <a href="{{route('customer.index')}}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Supplier Due Report</p>
                </a>
              </li> --}}
          </ul>
        </li>
        @endif
        @endif
        <li class="nav-item">
          <a href="{{url('change-password')}}" class="nav-link">
            <i class="fas fa-key"></i>
              <p>
                Change Password
              </p>
            </a>
          </li>

      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
