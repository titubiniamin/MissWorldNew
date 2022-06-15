<!DOCTYPE html>
<html class="h-100" lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>User Login</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('admin_assets/images/favicon.png')}}">
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
            <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="3" stroke-miterlimit="10"/>
        </svg>
    </div>
</div>
<!--*******************
    Preloader end
********************-->


<div class="container" style="margin-top:5%">
    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-4">
            <div class="fadeIn first" style="background:#000;display: flex;justify-content: center;">
                <img src="{{asset('admin_assets/images/logo-text.png')}}" id="icon" alt="User Icon" style="width: 82%;"
                     height="80px">
            </div>

            <div class="card">
                <h4 class="text-center mb-1 mt-3">Admin Authentication Request</h4>
                <div class="card-body">

                    <form class="col-md-12 p-t-10" role="form" method="POST" action="{{ route('post.admin.auth.request') }}">
                        @csrf
                        {{--                        <input type="hidden" name="_token" value="dO3qgOU7ZqiXqTAbp6Q4DGcHS3CeZpvhrQxklnt1">--}}
                        <div class="form-group">

                            <label class="control-label" for="email">Email</label>

                            <div>
                                {{--                                <input type="text" class="form-control" name="email" value="" id="email">--}}

                                <input type="email" readonly name="email" id="email" value="{{ $adminEmail??'' }}"
                                       class="form-control @error('email') is-invalid @enderror" required
                                       autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label" for="password">Comment</label>

                            <div>
                                <input type="text" class="form-control @error('comment') is-invalid @enderror"
                                       placeholder="Comment" name="comment" required >
                                @error('comment')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <div class="checkbox">
{{--                                    <input class="form-check-input" type="checkbox" name="remember"--}}
{{--                                           id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}

                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div>
                                <button type="submit" class="btn btn-block btn-primary">
                                    Send Request
                                </button>
                                @if(session('error'))
                                    <div class="text-danger" style="font-size: 16px; font-weight: 800;text-align: center;font-style: italic">
                                        {{session()->get('error')}}
                                    </div>
                                @endif
                                @if(session('success'))
                                    <div class="text-success" style="font-size: 16px; font-weight: 800;text-align: center;font-style: italic">
                                        {{session()->get('success')}}
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="text-center">
                            <a class="btn btn-link" href="{{ route('admin.login') }}">{{ __('Login') }}</a>
                        </div>
                        <input type="hidden" id="FINGER_PRINT" name="finger_print"/>

                    </form>
                </div>
            </div>
            <div class="text-center">
                @if (Route::has('password.request'))
                    {{-- <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                    </a> --}}

                @endif
            </div>
            <div class="text-center">
                {{-- <a class="btn btn-link" href="{{ route('register') }}">{{ __('Register') }}</a> --}}
            </div>
        </div>
    </div>
</div>

<!--**********************************
    Scripts
***********************************-->
<script src="{{asset('admin_assets/plugins/common/common.min.js')}}"></script>
<script src="{{asset('admin_assets/js/fingerprint2.js')}}"></script>
<script src="{{asset('admin_assets/js/custom.min.js')}}"></script>
<script src="{{asset('admin_assets/js/settings.js')}}"></script>
<script src="{{asset('admin_assets/js/gleek.js')}}"></script>
<script src="{{asset('admin_assets/js/styleSwitcher.js')}}"></script>
<script>
    let cookie_value = getCookie("FINGER_PRINT")
    if (cookie_value == null) {
        new Fingerprint2().get(function (result, components) {
            document.getElementById("FINGER_PRINT").value = result;
            createCookie("FINGER_PRINT", result, 100000);
        });
    } else document.getElementById("FINGER_PRINT").value = cookie_value;

    function createCookie(name, value, days) {
        if (days) {
            let date = new Date();
            date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
            var expires = "; expires=" + date.toUTCString();
        } else {
            var expires = ""
        }
        document.cookie = name + "=" + value + expires + "; path=/";
    }

    function getCookie(name) {
        let re = new RegExp(name + "=([^;]+)")
        let value = re.exec(document.cookie)
        return (value != null) ? decodeURIComponent(value[1]) : null
    }
</script>
</body>
</html>





