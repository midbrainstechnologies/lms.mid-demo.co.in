<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?=((!empty($seo['title']))?$seo['title']:'Login ')." | Cloud Based E-Lead Plateform"?></title>
  <meta name="keywords" content="<?=((!empty($seo['keyword']))?$seo['keyword']:'')." Cloud Based E-Lead Plateform"?>">
  <meta name="author" content="<?=((!empty($seo['author']))?$seo['author']:' ')?>">
  <meta name="description" content="<?=((!empty($seo['description']))?$seo['description']:'')." Cloud Based E-Lead Plateform"?>">
  <link rel="icon" href="<?=((!empty($seo['favicon']))?$seo['favicon']:url(env('APP_FAVICON')))?>" type="image/x-icon">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('asset_data/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('asset_data/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('asset_data/dist/css/adminlte.min.css')}}">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="{{url('/')}}"><img src="{{url(env('APP_LOGO'))}}" style="width: 100px" alt="CITC Logo"></a>
  </div>
  <!-- /.login-logo -->

  @yield('cardbody')


</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('asset_data/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('asset_data/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('asset_data/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
