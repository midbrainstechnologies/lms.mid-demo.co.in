<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="{{url('/super-admin/dashboard')}}" class="nav-link">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>
            Dashboard
          </p>
        </a>
      </li>


      <li class="nav-header">Businesses</li>
      <li class="nav-item">
        <a href="{{url('/super-admin/createbusiness')}}" class="nav-link">
          <i class="nav-icon fa fa-plus"></i>
          <p>
            Create Business

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/super-admin/managebusiness') }}" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Business List
          </p>
        </a>
      </li>

      <li class="nav-header">Admins</li>
      <li class="nav-item">
        <a href="{{url('/super-admin/manageadmins/create')}}" class="nav-link">
          <i class="nav-icon fa fa-plus"></i>
          <p>
            Create Admin
          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{ url('/super-admin/admin-list') }}" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Admins List
          </p>
        </a>
      </li>

      <li class="nav-header">Profile </li>
      <li class="nav-item">
        <a href="{{url('/super-admin/profile')}}" class="nav-link">
          <i class="nav-icon fa fa-user"></i>
          <p>
            Profile
          </p>
        </a>
      </li>


      <li class="nav-item">
        <a href="{{url('/logout')}}" class="nav-link">
          <i class="nav-icon fa fa-sign-out"></i>
          <p>
            Logout
          </p>
        </a>
      </li>


      {{-- <li class="nav-item menu-open">
        <a href="#" class="nav-link ">
          <i class="nav-icon fas fa-tachometer-alt"></i>
          <p>
            Dashboard
            <i class="right fas fa-angle-left"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="#" class="nav-link ">
              <i class="far fa-circle nav-icon"></i>
              <p>Active Page</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="far fa-circle nav-icon"></i>
              <p>Inactive Page</p>
            </a>
          </li>
        </ul>
      </li> --}}

    </ul>
  </nav>
  <!-- /.sidebar-menu -->
