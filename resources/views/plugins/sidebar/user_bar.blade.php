<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('user/pagination') }}" class="brand-link">
    <img src="{{asset('/dist/img/logo.ico')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">&ensp;WEB &ensp;|&ensp; {{ session('section') }}</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('/dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('user/pagination') }}" class="d-block">{{ session('name') }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          @if (url()->current() == route('user/pagination'))
            <a href="{{ route('user/pagination') }}" class="nav-link active">
          @else
            <a href="{{ route('user/pagination') }}" class="nav-link">
          @endif
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Pagination
              </p>
            </a>
        </li>
        <li class="nav-item">
          @if (url()->current() == route('user/load_more'))
            <a href="{{ route('user/load_more') }}" class="nav-link active">
          @else
            <a href="{{ route('user/load_more') }}" class="nav-link">
          @endif
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Load More
              </p>
            </a>
        </li> 
        <li class="nav-item">
          @if (url()->current() == route('user/table_switching'))
            <a href="{{ route('user/table_switching') }}" class="nav-link active">
          @else
            <a href="{{ route('user/table_switching') }}" class="nav-link">
          @endif
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Table Switching
              </p>
            </a>
        </li> 
        <li class="nav-item">
          @if (url()->current() == route('user/keyup_search'))
            <a href="{{ route('user/keyup_search') }}" class="nav-link active">
          @else
            <a href="{{ route('user/keyup_search') }}" class="nav-link">
          @endif
              <i class="nav-icon far fa-file-alt"></i>
              <p>
                Keyup Search
              </p>
            </a>
        </li> 
        @include('plugins/sidebar/logout')
      </ul>
    </nav>
    <!-- /.sidebar-menu -->
  </div>
  <!-- /.sidebar -->
</aside>
