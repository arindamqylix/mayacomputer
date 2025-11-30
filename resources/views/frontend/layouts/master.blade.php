<!DOCTYPE html>
<html lang="zxx">

<head>
    <!-- meta tag -->
    <meta charset="utf-8">
    <title>@yield('title')</title>
    <meta name="description" content="">
    <!-- responsive tag -->
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- favicon -->
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <link rel="shortcut icon" type="image/x-icon" href="images/fav.png">
    <!-- bootstrap v4 css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- font-awesome css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <!-- animate css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/animate.css')}}">
    <!-- owl.carousel css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/owl.carousel.css')}}">
    <!-- slick css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/slick.css')}}">
    <!-- magnific popup css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/magnific-popup.css')}}">
    <!-- Offcanvas CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/off-canvas.css')}}">
    <!-- flaticon css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/flaticon.css')}}">
    <!-- flaticon2 css  -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/fonts/fonts2/flaticon.css')}}">
    <!-- rsmenu CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/rsmenu-main.css')}}">
    <!-- rsmenu transitions CSS -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/rsmenu-transitions.css')}}">
    <!-- style css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/style.css')}}">
    <!-- responsive css -->
    <link rel="stylesheet" type="text/css" href="{{asset('frontend/css/responsive.css')}}">
    <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>

<body class="home1">
    <!--Preloader area start here-->
    <!-- <div class="book_preload">
        <div class="book">
            <div class="book__page"></div>
            <div class="book__page"></div>
            <div class="book__page"></div>
        </div>
    </div> -->
    <!--Preloader area end here-->

    @include('frontend.layouts.header')
        @yield('content')
    @include('frontend.layouts.footer')
</body>

</html>