<nav class="main-header navbar navbar-expand navbar-dark">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="javascript:;" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>


    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">

	  <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="javascript:;">
          <!-- <i class="far fa-bell"></i> -->
		  <span class="fa fa-angle-down"></span> {{ auth()->user()->name }}
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">

          <div class="dropdown-divider"></div>
          <a href="{{ route('logout') }}" onclick="event.preventDefault();
            document.getElementById('logout-form').submit();" class="dropdown-item">
            <i class="fa fa-times float-right"></i> Logout
          </a>
		    <form id="logout-form" action="{{ route('logout') }}"
                method="POST" style="display: none;">
          		@csrf
        	</form>
			    <a href="{{ route('admin.changePassword') }}" class="dropdown-item">
            <i class="fa fa-key float-right"></i> Change Password
          </a>

        </div>
      </li>
      <!-- <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button"><i
            class="fas fa-th-large"></i></a>
      </li> -->
    </ul>
  </nav>
