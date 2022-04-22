<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

     <!-- CSRF Token -->
     <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Admin | @yield('title')</title>

  @include('admin.layouts.partials.header')
</head>
<body class="hold-transition @if(Request::segment(2) == 'home') dark-mode @else light-mode @endif sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
    <div class="wrapper">

      <!-- Preloader -->
      <!--<div class="preloader flex-column justify-content-center align-items-center">
        <img class="animation__wobble" src="{{ asset('assets/dist/img/AdminLTELogo.png')}}" alt="AdminLTELogo" height="60" width="60">
      </div>-->

      <!-- Navbar -->
      @include('admin.layouts.partials.topnavigation')
      <!-- /.navbar -->

      <!-- Sidebar -->
      @include('admin.layouts.partials.sidebar')
      <!-- Sidebar -->

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">

      @yield('content')

      </div>
      <!-- /.content-wrapper -->

      <!-- Control Sidebar -->
      <aside class="control-sidebar control-sidebar-dark">
          <!-- Control sidebar content goes here -->
      </aside>
      <!-- /.control-sidebar -->

      <!-- Main Footer -->
      @include('admin.layouts.partials.footer')
</div>
<!-- ./wrapper -->
@include('admin.layouts.partials.footerscript')
@yield('script')
</body>
</html>
