<!doctype html>
<html lang="en">

    <head>
        <title>Laravel 8 Toastr Notification Example - websolutionstuff.com</title>

        <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-
     alpha/css/bootstrap.css" rel="stylesheet">

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        <link rel="stylesheet" type="text/css"
              href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
        <meta charset="UTF-8">
        <meta name="viewport"
              content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>

    </head>

<body>
<form action="{{route('aa.store')}}" method="post">
    @csrf
    <input type="text" name="name">
    <button type="submit">Submit</button>
</form>

<script>
{{--    @if(Session::has('message'))--}}
{{--        toastr.options =--}}
{{--        {--}}
{{--            "closeButton" : true,--}}
{{--            "progressBar" : true--}}
{{--        }--}}
{{--    toastr.success("{{ session('message') }}");--}}
{{--    @endif--}}

        @if(session()->has('message'))
        toastr.options={
            "close":true,
        "progressBar":true
    }
    toastr.success("{{session('message')}}")
        @endif

        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.error("{{ session('error') }}");
    @endif

        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.info("{{ session('info') }}");
    @endif

        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
    toastr.warning("{{ session('warning') }}");
    @endif
</script>
</body>
</html>
