<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Register</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin_assets/assets/images/favicon.png')}}">
    <!-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous"> -->
    <link href="{{asset('admin_assets/css/style.css')}}" rel="stylesheet">

</head>

<body class="h-100 app">

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



<div class="container" style="margin-top:5%">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <h3 class="text-center mb-4">Register</h3>
            <div class="card">
                <div class="card-body">
                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        {{--                        <input type="hidden" name="_token" value="dO3qgOU7ZqiXqTAbp6Q4DGcHS3CeZpvhrQxklnt1">--}}

                        <div class="form-group">
                            <label class="control-label" for="email">Name</label>

                            <div>
                                {{--                                <input type="text" class="form-control" name="email" value="" id="email">--}}
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="email">Email</label>

                            <div>
                                {{--                                <input type="text" class="form-control" name="email" value="" id="email">--}}
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Password</label>

                            <div>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label" for="password">Confirm Password</label>

                            <div>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                            </div>
                        </div>


                        <div class="form-group">
                            <div>
                                <div class="checkbox">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    Register
                                </button>
                                @if(session('error'))
                                    <div class="text-danger">
                                        {{session()->get('error')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
{{--            <div class="text-center">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot Your Password?') }}--}}
{{--                    </a>--}}

{{--                @endif--}}
{{--            </div>--}}
            <div class="text-center">
                <a class="btn btn-link" href="{{ route('login') }}">{{ __('Login') }}</a>
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('admin_assets/plugins/common/common.min.js')}}"></script>
<script src="{{asset('admin_assets/js/custom.min.js')}}"></script>
<script src="{{asset('admin_assets/js/settings.js')}}"></script>
<script src="{{asset('admin_assets/js/gleek.js')}}"></script>
<script src="{{asset('admin_assets/js/styleSwitcher.js')}}"></script>
</body>
</html>





