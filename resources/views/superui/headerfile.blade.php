    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title><?=((!empty($seo['title']))?$seo['title']:'Dashboard ')." | Cloud Based Lead Management Platform"?></title>
    <meta name="keywords" content="<?=((!empty($seo['keyword']))?$seo['keyword']:'')." Cloud Based Lead Management Platform"?>">
    <meta name="author" content="<?=((!empty($seo['author']))?$seo['author']:' ')?>">
    <meta name="description" content="<?=((!empty($seo['description']))?$seo['description']:'')." Cloud Based Lead Management Platform"?>">
    <link rel="icon" href="<?=((!empty($seo['favicon']))?$seo['favicon']:url(env('APP_FAVICON')))?>" type="image/x-icon">


    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Font Awesome Icons -->
    {{-- <link rel="stylesheet" href="{{url('asset_data/plugins/fontawesome-free/css/all.min.css')}}"> --}}
    <!-- Theme style -->
    <link rel="stylesheet" href="{{url('asset_data/dist/css/adminlte.min.css')}}">
