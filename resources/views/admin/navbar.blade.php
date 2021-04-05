<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{route('home')}}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <!-- Messages Dropdown Menu -->
      @guest
      @else
      <li class="dropdown user user-menu open" >
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
          <span class="hidden-xs">{{ Auth::user()->name }}</span>
        </a>
        <ul class="dropdown-menu" style="margin-left: -243px;">
          <!-- User image -->
          @php $data = App\User::where('id',Auth::user()->id)->first() @endphp
          <li class="user-header">
          <img src="{{$data->image ?? ''}}" height="50px" width="50px" class="img-circle" alt="User Image">
            
            <p>
                
              <small>Member since Nov. 2020</small>
            </p>
          </li>
          <!-- Menu Body -->
          <li class="user-body">
            <!-- /.row -->
          </li>
          <!-- Menu Footer-->
          <li class="user-footer">
            <div class="pull-left">
              <a href="{{route('profile')}}" class="btn btn-default btn-flat">Profile</a>
              <a href="{{ route('logout') }}" style="float: right;" class="btn btn-default btn-flat" onclick="event.preventDefault();
              document.getElementById('logout-form').submit();">Sign out</a>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                @csrf
            </form>
            </div>
          </li>
        </ul>
    </li>
    @endguest
    </ul>
  </nav>