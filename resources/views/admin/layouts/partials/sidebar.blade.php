 <!-- Main Sidebar Container -->
 <aside class="main-sidebar sidebar-dark-primary elevation-4">
   <!-- Brand Logo -->
   <a href="{{ route('admin.home') }}" class="brand-link">
    <img src="{{ asset(env('APP_LOGO'))}}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    <span class="brand-text font-weight-light">{{env('APP_NAME')}}</span>
  </a>

   <!-- Sidebar -->
   <div class="sidebar">
     <!-- Sidebar Menu -->
     <nav class="mt-2">
       <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">


         <li class="nav-item">
           <a href="{{route('admin.home')}}" class="nav-link {{ (\Request::segment(2) == 'home') ? 'active' : '' }}">
             <i class="nav-icon fas fa-tachometer-alt"></i>
             <p>Dashboard</p>
           </a>
         </li>

         @permission('view.roles')
         <li class="nav-item">
           <a href="{{route('role.index')}}" class="nav-link {{ (\Request::segment(2) == 'role') ? 'active' : '' }}">
             <i class="nav-icon fas fa-users"></i>
             <p>Roles/Permissions</p>
           </a>
         </li>
         @endpermission

         @permission('view.users')
          <li class="nav-item">
            <a href="{{route('users.index')}}" class="nav-link {{ (\Request::segment(2) == 'users') ? 'active' : '' }}">
              <i class="nav-icon fas fa-user"></i>
              <p>Users</p>
            </a>
          </li>
         @endpermission

         @permission('view.publications')
          <li class="nav-item">
            <a href="{{route('publication.index')}}" class="nav-link {{ (\Request::segment(2) == 'publication') ? 'active' : '' }}">
              <i class="nav-icon fas fa-book"></i>
              <p>Publication</p>
            </a>
          </li>
         @endpermission
       </ul>
     </nav>
     <!-- /.sidebar-menu -->
   </div>
   <!-- /.sidebar -->
 </aside>
