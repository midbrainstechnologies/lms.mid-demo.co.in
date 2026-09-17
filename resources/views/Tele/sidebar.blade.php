<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="{{url('/tele-caller/dashboard')}}" class="nav-link">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>
            Dashboard

          </p>
        </a>
      </li>


      {{-- menu --}}

      @if (Auth::user()->can_create_lead == '1')
        <li class="nav-item">
        <a href="{{url('/tele-caller/create')}}" class="nav-link">
            <i class="nav-icon fa fa-plus"></i>
            <p>
            Create Lead
            </p>
        </a>
        </li>
        <li class="nav-item">
        <a href="{{url('/tele-caller/upload-list')}}" class="nav-link">
            <i class="nav-icon fa fa-upload"></i>
            <p>
            Upload Leads
            </p>
        </a>
        </li>
        @endif

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Leads
            <i class="fa fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('/tele-caller/all-leads')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>All Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/transferred-list')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Transferred Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/captured-list')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Captured Leads</p>
            </a>
          </li>

        </ul>
      </li>

      <li class="nav-item">
        <a href="{{url('/tele-caller/schedule')}}" class="nav-link">
          <i class="nav-icon fa fa-clock-o"></i>
          <p>
            Lead Schedule

          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="#" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Leads Status
            <i class="fa fa-angle-left right"></i>
          </p>
        </a>
        <ul class="nav nav-treeview">
          <li class="nav-item">
            <a href="{{url('/tele-caller/list/hot')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Hot Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/list/warm')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Warm Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/list/cold')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Cold Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/list/dead')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Dead Leads</p>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{url('/tele-caller/list/closed')}}" class="nav-link">
              <i class="fa fa-circle-o nav-icon"></i>
              <p>Closed Leads</p>
            </a>
          </li>
        </ul>
      </li>




      {{-- end menu  --}}
      <li class="nav-item">
        <a href="{{url('/tele-caller/profile')}}" class="nav-link">
          <i class="nav-icon fa fa-user"></i>
          <p>
            Profile

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/tele-caller/changepassword')}}" class="nav-link">
          <i class="nav-icon fa fa-lock"></i>
          <p>
            Change Password

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
