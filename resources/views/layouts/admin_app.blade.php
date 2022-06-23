<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>
{{--        @stack('title')--}}
    </title>
    <script src="{{asset('admin_assets/plugins/common/common.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('admin_assets/css/all.min.css')}}"/>
    <link href="{{asset('admin_assets/css/style.css')}}" rel="stylesheet">
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
{{--    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>--}}
    <script src="https://localhost/MissWorld/sponsor/asset/customJS/config.js"></script>
    <script src="https://localhost/MissWorld/sponsor/asset/customJS/step_change.js"></script>
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css"/>--}}
    <link href="{{asset('admin_assets/css/jquery.dataTables.min.css')}}" rel="stylesheet">
{{--    <link href="{{asset('admin_assets/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet">--}}
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>--}}
    <script src="{{asset('admin_assets/js/jquery.validate.js')}}"></script>
    <script src="{{asset('admin_assets/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/bootstrap.4.1.3.min.js')}}"></script>
{{--    <script src="{{asset('admin_assets/js/dataTables.bootstrap4.min.js')}}"></script>--}}


    {{--    <link href="{{asset('css/app.css')}}" rel="stylesheet">--}}

</head>
<body>

<!--*******************
    Preloader start
********************-->
<div id="preloader">
    <div class="loader">
        <svg class="circular" viewBox="25 25 50 50">
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
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
                        <img style=" width: 97%;height: 75%;margin:-12%"
                             src="{{asset('admin_assets/images/logo-text.png')}}" alt="">
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
