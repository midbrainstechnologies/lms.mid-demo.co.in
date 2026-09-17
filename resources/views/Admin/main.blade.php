
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

@if(session('plan_warning'))
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    Swal.fire({
        icon: 'warning',
        title: 'Plan Expiring Soon',
        text: "{{ session('plan_warning') }}",
        confirmButtonText: 'Ok'
    });
</script>
@endif


</body>
</html>
