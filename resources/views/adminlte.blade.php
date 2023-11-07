<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Pet Shop Lontar | {{ $subtitle }}</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url ('plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url ('dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="dashboard" class="brand-link">
      <img src="../../dist/img/kitty.png" alt="AdminLTE Logo" class="brand-image" style="opacity: .8">
      <i class=""></i>
      <span class="brand-text  font-weight-bold">PetShop Lontar</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        {{-- <div class="image">
          <img src="../../dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> --}}
        <div class="info">
          <a href="#" class="d-block">Hi, {{ Auth::user()->name }} <br> [{{ Auth::user()->role}}]</a>
        </div>
      </div>

      <!-- SidebarSearch Form -->
      {{-- <div class="form-inline">
        <div class="input-group" data-widget="sidebar-search">
          <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
          <div class="input-group-append">
            <button class="btn btn-sidebar">
              <i class="fas fa-search fa-fw"></i>
            </button>
          </div>
        </div>
      </div> --}}

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="{{url ('dashboard')}}" class="nav-link">
              <i class="nav-icon fa fa-home"></i>
              <p class="text">Dashboard</p>
            </a>
          </li>

          <li class="nav-item">
            <a href="{{url ('products')}}" class="nav-link">
              <i class="nav-icon fa fa-box"></i>
              <p class="text">Products</p>
            </a>
          </li>

          @if (Auth::user()->role == 'Kasir' || Auth::user()->role == 'Admin' || Auth::user()->role == 'Owner')
          <li class="nav-item">
            <a href="{{url ('transactions')}}" class="nav-link">
              <i class="nav-icon fa fa-book"></i>
              <p class="text">Transactions</p>
            </a>
          </li>
          @endif

          @if (Auth::user()->role == 'Admin')
          <li class="nav-item">
            <a href="{{url ('users')}}" class="nav-link">
              <i class="nav-icon fa fa-users"></i>
              <p class="text">Users</p>
            </a>
          </li>
          @endif

          @if (Auth::user()->role == 'Admin')
          <li class="nav-item">
            <a href="{{url ('log')}}" class="nav-link">
              <i class="nav-icon fa fa-history"></i>
              <p class="text">Log</p>
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a href="{{route ('logout')}}" class="nav-link">
              <i class="nav-icon fas fa-sign-out-alt text-danger"></i>
              <p class="text-danger">Logout</p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    {{-- <div class="float-right d-none d-sm-block">
      <b>Version</b> 3.2.0
    </div> --}}
    <strong>Copyright &copy; 2023 <a href="">Wananda Dilla Zahra</a>.</strong> All rights reserved.
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{url ('plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url ('plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url ('dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->

<script src="{{ url('plugins/chart.js/Chart.min.js')}}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ url('dist/js/pages/dashboard3.js')}}"></script>
</body>
</html>