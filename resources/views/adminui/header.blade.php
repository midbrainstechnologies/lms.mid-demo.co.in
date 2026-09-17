<?php $setdashboardurl = "#";
    if(Auth::user()->user_role == "super-admin"){
        $setdashboardurl = url('/super-admin/dashboard');
    }else if(Auth::user()->user_role == "admin"){
        $setdashboardurl = url('/admin/dashboard');
    }else if(Auth::user()->user_role == "lead-creater"){
        $setdashboardurl = url('/lead-creater/dashboard');
    }else if(Auth::user()->user_role == "tele-caller"){
        $setdashboardurl = url('/tele-caller/dashboard');
    }

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fa fa-list"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="{{ $setdashboardurl }}" class="nav-link">Home</a>
        </li>


    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <?php

        $notificationcall = App\Models\Notification::select()->where('user_id',Auth::user()->id)->where('is_read','0')->orderby('id','desc')->get();

        ?>


        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="fa fa-bell"></i>
                <span class="badge badge-warning navbar-badge">{{count($notificationcall)}}</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <span class="dropdown-header">{{count($notificationcall)}} Notifications</span>

                @foreach ($notificationcall as $nlist)
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <i class="fa fa-bell"></i> {{$nlist['short_line']}}
                    <span class="float-right text-muted text-sm">{{date("M, d h:i",strtotime($nlist['created_at']))}}</span>
                </a>
                @endforeach


                <div class="dropdown-divider"></div>
                <a href="{{ '#' }}" class="dropdown-item dropdown-footer">See All Notifications</a>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fa fa-desktop"></i>
            </a>
        </li>
        <li class="dropdown user user-menu" style="margin-top: 8px;">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                <img src="<?= !empty(Auth::user()->photo) ? url(Auth::user()->photo) : url(env('APP_LOGO')) ?>" class="user-image" alt="{{ Auth::user()->name }}">
                <span class="hidden-xs">{{ Auth::user()->name }}</span>
            </a>
            <ul class="dropdown-menu">
                <!-- User image -->
                <li class="user-header">
                    <img  src="<?= !empty(Auth::user()->photo) ? url(Auth::user()->photo) : url(env('APP_LOGO')) ?>" class="img-circle" alt="{{ Auth::user()->name }}">

                    <p>
                        {{ Auth::user()->name }}<br>
                        @if (Auth::user()->user_role == 'admin')
                            {{ 'Admin' }}
                        @elseif (Auth::user()->user_role == 'lead-creater')
                            {{ 'Lead Creater' }}
                        @elseif (Auth::user()->user_role == 'tele-caller')
                            {{ 'Tele-caller' }}
                        @endif
                    </p>
                </li>
                <!-- Menu Body -->

                <!-- Menu Footer-->
                <li class="user-footer">

                    <div class="pull-right">
                        <a href="{{url('/logout')}}" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                </li>
            </ul>
        </li>

    </ul>
</nav>
<!-- /.navbar -->

<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ $setdashboardurl }}" class="brand-link">
        <img src="<?= !empty($seo['logo']) ? $seo['logo'] : url(env('APP_LOGO')) ?>" alt="Logo"
            class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{ env('SHORTNAME') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= !empty(Auth::user()->photo) ? url(Auth::user()->photo) : url(env('APP_LOGO')) ?>"
                    class="img-circle elevation-2" alt="{{ Auth::user()->name }}">
            </div>
            <div class="info">
                <a href="{{$setdashboardurl}}" class="d-block">{{ Auth::user()->name }}</a>
            </div>
        </div>


        @if (Auth::user()->user_role == 'admin')
            @include('Admin.sidebar')
        @elseif (Auth::user()->user_role == 'lead-creater')
            @include('LeadCreator.sidebar')
        @elseif (Auth::user()->user_role == 'tele-caller')
            @include('Tele.sidebar')
        @endif


    </div>
    <!-- /.sidebar -->
</aside>
