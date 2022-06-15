<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
        @stack('title')
    </title>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css" integrity="sha512-KfkfwYDsLkIlwQp6LFnl8zNdLGxu9YAA1QvwINks4PhcElQSvqcyVLLD9aMhXd13uQjoXtEKNosOWaZqXgel0g==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link href="{{asset('admin_assets/css/style.css')}}" rel="stylesheet">
{{--    <link href="{{asset('css/app.css')}}" rel="stylesheet">--}}

</head>

<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10" />
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->
<!--**********************************
        Main wrapper start
    ***********************************-->
<div id="main-wrapper">
    <!--**********************************
           Nav header start
       ***********************************-->
    <div class="nav-header" style="background-color: #171718">
        <div class="brand-logo">
            <a href="index.html">
                <b class="logo-abbr"><img src="{{asset('admin_assets/images/logo.png')}}" alt=""> </b>
                <span class="logo-compact"><img src="{{asset('admin_assets/images/logo-compact.png')}}" alt=""></span>
                <span class="brand-title">
                        <img style=" width: 97%;height: 75%;margin:-12%" src="{{asset('admin_assets/images/logo-text.png')}}" alt="">
                    </span>
            </a>
        </div>
    </div>
    <!--**********************************
        Nav header end
    ***********************************-->
    @include('layouts.admin_header')
    @include('layouts.admin_sidebar')
    <div class="content-body">
        <div class="container-fluid">
        @yield('main-content')
        </div>
    </div>
    <!--**********************************
          Content body end
      ***********************************-->
    @include('layouts.admin_footer')

</div>
<!--**********************************
    Main wrapper end
***********************************-->




<!--**********************************
    Scripts
***********************************-->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script src="{{asset('admin_assets/plugins/common/common.min.js')}}"></script>
<script src="{{asset('admin_assets/js/custom.min.js')}}"></script>
<script src="{{asset('admin_assets/js/settings.js')}}"></script>
<script src="{{asset('admin_assets/js/gleek.js')}}"></script>
<script src="{{asset('admin_assets/js/styleSwitcher.js')}}"></script>
<!-- Chartjs -->
<script src="{{asset('admin_assets/plugins/chart.js/Chart.bundle.min.js')}}"></script>
<!-- Circle progress -->
<script src="{{asset('admin_assets/plugins/circle-progress/circle-progress.min.js')}}"></script>
<!-- Datamap -->
<script src="{{asset('admin_assets/plugins/d3v3/index.js')}}"></script>
<script src="{{asset('admin_assets/plugins/topojson/topojson.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/datamaps/datamaps.world.min.js')}}"></script>
<!-- Morrisjs -->
<script src="{{asset('admin_assets/plugins/raphael/raphael.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/morris/morris.min.js')}}"></script>
<!-- Pignose Calender -->
<script src="{{asset('admin_assets/plugins/moment/moment.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/pg-calendar/js/pignose.calendar.min.js')}}"></script>
<!-- ChartistJS -->
<script src="{{asset('admin_assets/plugins/chartist/js/chartist.min.js')}}"></script>
<script src="{{asset('admin_assets/plugins/chartist-plugin-tooltips/js/chartist-plugin-tooltip.min.js')}}"></script>
<script src="{{asset('admin_assets/js/dashboard/dashboard-1.js')}}"></script>
</body>
</html>
