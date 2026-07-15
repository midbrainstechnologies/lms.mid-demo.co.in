<!-- Sidebar Menu -->
<nav class="mt-2">
    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
        <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->

        <li class="nav-item">
            <a href="{{ url('/admin/dashboard') }}" class="nav-link">
                <i class="nav-icon fa fa-dashboard"></i>
                <p>
                    Dashboard

                </p>
            </a>
        </li>
        <li class="nav-header">Leads</li>
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
                    <a href="{{ url('/admin/creator-list') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Creator's Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/online-list') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Online Leads</p>
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ url('/admin/upload-list') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Upload Leads</p>
                    </a>
                </li>

            </ul>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/allleads') }}" class="nav-link">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    All Leads

                </p>
            </a>
        </li>
        <li class="nav-header">Leads Status</li>
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
                    <a href="{{ url('/admin/list/new') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>New Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/list/t_approve') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Approve Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/list/t_process') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Process Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/list/t_hot') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Hot Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/list/t_complete') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Complete Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/list/callback')}}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Callback Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/list/ringing')}}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Ringing Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{url('/admin/list/switchoff')}}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Switch Off Leads</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ url('/admin/list/t_delete') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Deleted Leads</p>
                    </a>
                </li>


            </ul>
        </li>


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
                    <a href="{{ url('/admin/mylist/t_complete') }}" class="nav-link">
                        <i class="fa fa-circle-o nav-icon"></i>
                        <p>Approved Leads</p>
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


        <li class="nav-header">Users</li>
        <li class="nav-item">
            <a href="{{ url('/admin/users') }}" class="nav-link">
                <i class="nav-icon fa fa-list"></i>
                <p>
                    All Users

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/users/tele-caller') }}" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                    Telecaller

                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/admin/users/lead-creater') }}" class="nav-link">
                <i class="nav-icon fa fa-users"></i>
                <p>
                    Lead Creator

                </p>
            </a>
        </li>
        <!--<li class="nav-header">Subscription</li>-->
        <!--<li class="nav-item">-->
        <!--    <a href="{{ url('/admin/subscription/subscription-details') }}" class="nav-link">-->
        <!--        <i class="nav-icon fa fa-user"></i>-->
        <!--        <p>-->
        <!--            Subscription Details-->

        <!--        </p>-->
        <!--    </a>-->
        <!--</li>-->
        <li class="nav-header">Setting / Profile</li>
        <li class="nav-item">
            <a href="{{ url('/admin/profile') }}" class="nav-link">
                <i class="nav-icon fa fa-user"></i>
                <p>
                    Profile

                </p>
            </a>
        </li>
        <li class="nav-item">
            <a href="{{ url('/admin/changepassword') }}" class="nav-link">
                <i class="nav-icon fa fa-lock"></i>
                <p>
                    Change Password

                </p>
            </a>
        </li>

        <li class="nav-item">
            <a href="{{ url('/logout') }}" class="nav-link">
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
