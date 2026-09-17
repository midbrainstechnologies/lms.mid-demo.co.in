
<!DOCTYPE html>

<html lang="en">
<head>
    @include('adminui.headerfile')
    @yield('headerfile')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 @include('adminui.header')
 @yield('header')


 @yield('body')


  <!-- Main Footer -->
  @include('adminui.footer')
  @yield('footer')
</div>
<!-- ./wrapper -->
@include('adminui.footerfile')
@yield('footerfile')

</body>
</html>
