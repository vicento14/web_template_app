<aside class="main-sidebar sidebar-dark-primary elevation-4">
  <!-- Brand Logo -->
  <a href="{{ route('admin/dashboard') }}" class="brand-link">
    <img src="{{asset('/dist/img/logo.ico')}}" alt="Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">&ensp;WEB &ensp;|&ensp; Admin</span>
  </a>

  <!-- Sidebar -->
  <div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
      <div class="image">
        <img src="{{asset('/dist/img/user.png')}}" class="img-circle elevation-2" alt="User Image">
      </div>
      <div class="info">
        <a href="{{ route('admin/dashboard') }}" class="d-block">{{ session('name') }}</a>
      </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
      <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
             with font-awesome or any other icon font library -->
        <li class="nav-item">
          @if (url()->current() == route('admin/dashboard'))
            <a href="{{ route('admin/dashboard') }}" class="nav-link active">
          @else
            <a href="{{ route('admin/dashboard') }}" class="nav-link">
          @endif
              <i class="nav-icon fas fa-bus"></i>
              <p>
                Dashboard
              </p>
            </a>
        </li>
        <li class="nav-item">
          @if (url()->current() == route('admin/accounts'))
            <a href="{{ route('admin/accounts') }}" class="nav-link active">
          @else
            <a href="{{ route('admin/accounts') }}" class="nav-link">
          @endif
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Account Management
              </p>
            </a>
        </li>
        <li class="nav-item">
          @if (url()->current() == route('admin/sample1'))
            <a href="{{ route('admin/sample1') }}" class="nav-link active">
          @else
            <a href="{{ route('admin/sample1') }}" class="nav-link">
          @endif
              <i class="nav-icon fas fa-user-cog"></i>
              <p>
                Sample 1
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
