
<!DOCTYPE html>

<html lang="en">
<head>
    @include('superui.headerfile')
    @yield('headerfile')
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper">
 @include('superui.header')
 @yield('header')


 @yield('body')


  <!-- Main Footer -->
  @include('superui.footer')
  @yield('footer')
</div>
<!-- ./wrapper -->
@include('superui.footerfile')
@yield('footerfile')

</body>
</html>
