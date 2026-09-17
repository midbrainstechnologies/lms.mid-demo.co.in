<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
      <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

      <li class="nav-item">
        <a href="{{url('/lead-creater/dashboard')}}" class="nav-link">
          <i class="nav-icon fa fa-dashboard"></i>
          <p>
            Dashboard

          </p>
        </a>
      </li>

      <li class="nav-item">
        <a href="{{url('/lead-creater/create')}}" class="nav-link">
          <i class="nav-icon fa fa-plus"></i>
          <p>
            Create Lead

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/lead-creater/myleads')}}" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            My Leads

          </p>
        </a>
      </li>

      @if (Auth::user()->is_online == "1")


      <li class="nav-item">
        <a href="{{url('/lead-creater/onlineleads')}}" class="nav-link">
          <i class="nav-icon fa fa-list"></i>
          <p>
            Online Leads

          </p>
        </a>
      </li>
      @endif
      @if (Auth::user()->is_billing == "1")
      <li class="nav-header">Approve Leads</li>
        <li class="nav-item">
            <a href="#" class="nav-link">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    My Leads Status
                    <i class="fa fa-angle-left right"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{ url('/admin/mylist/closed') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Closed Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/mylist/a_process') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Under Process Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/mylist/a_complete') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Completed Leads</p>
                    </a>
                </li>





            </ul>
        </li>
        <li class="nav-item">
            <a href="{{url('/admin/schedule')}}" class="nav-link">
              <i class="nav-icon fa fa-clock-o"></i>
              <p>
                Lead Schedule

              </p>
            </a>
          </li>

        <li class="nav-header">Billing </li>
        <li class="nav-item">
            <a href="{{ url('/admin/service') }}" class="nav-link">
                <i class="nav-icon fa fa-money"></i>
                <p>
                    All Service

                </p>
            </a>
        </li>

      @endif

      <li class="nav-header">Profile </li>
      <li class="nav-item">
        <a href="{{url('/lead-creater/profile')}}" class="nav-link">
          <i class="nav-icon fa fa-user"></i>
          <p>
            Profile

          </p>
        </a>
      </li>
      <li class="nav-item">
        <a href="{{url('/lead-creater/changepassword')}}" class="nav-link">
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
