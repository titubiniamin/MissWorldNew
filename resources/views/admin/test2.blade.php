
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Miss World Bangladesh 2021 </title>
    <meta charset="utf-8">
    {{--    <meta name="viewport" content="width=device-width, initial-scale=1">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
{{--    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>--}}
{{--    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">--}}
{{--    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/dataTables.buttons.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.html5.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.print.min.js"></script>--}}
{{--    <script src="https://cdn.datatables.net/buttons/1.5.6/js/buttons.flash.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">--}}
{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/css/bootstrap-datetimepicker.css">--}}

{{--    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.17.47/js/bootstrap-datetimepicker.min.js"></script>--}}
{{--    <link rel="shortcut icon" href="https://missworldbangladesh.com/application-form/logo.png" type="image/x-icon">--}}
{{--    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css">--}}
{{--    <script src="https://localhost/MissWorld/sponsor/asset/customJS/config.js"></script>--}}


<body>
{{--@dd($user)--}}
{{--<ul class="pagination">--}}
{{--    <li class="disabled"><span>«</span></li>--}}
{{--    <li class="active"><span>1</span></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=2">2</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=3">3</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=4">4</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=5">5</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=6">6</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=7">7</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=8">8</a></li>--}}
{{--    <li class="disabled"><span>...</span></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=32">32</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=33">33</a></li>--}}
{{--    <li><a href="https://localhost/MissWorld/sponsor/admin-dashboard?page=2" rel="next">»</a></li>--}}
{{--</ul>--}}
<div class="jumbotron text-left" style="background-color: black;padding:0%;margin:0%;">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <a href="https://localhost/MissWorld/sponsor/admin-dashboard">
                    <img src="https://localhost/MissWorld/sponsor/images/logo.png" style="max-height: 100px;">
                </a>
            </div>
            <div class="col-md-4"><h1>Admin Panel</h1></div>

            <div class="col-md-4"  style="text-align:right;padding-top:5px;">
                <p style="color:aliceblue;"> Welcome admin</p>
                <a href="https://localhost/MissWorld/sponsor/logout" class="btn btn-default">Logout</a>

            </div>
        </div>

    </div>

</div>
<hr>
<div class="container">
    <div class=""  style="max-height: 700px; overflow: auto">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($user as $_user)
                @php
                    $limit = request()->query("limit")?request()->query("limit"):'';
                    $page=request()->query("page")?request()->query("page"):'';
                @endphp
                <tr>
                    <th scope="row">{{ $loop->iteration + ($limit && $page ? ($limit * ($page - 1 )) : 0 )}}</th>
                    <td>{{ $_user->id ?? '' }}</td>
                    <td>{{ $_user->name ?? '' }}</td>
                    <td>{{ $_user->email ?? '' }}</td>
                    <td>
                        <div class="d-flex justify-content-between">
                            <button class="btn btn-success btn-sm">Edit</button>
                            <button class="btn btn-danger btn-sm">Delete</button>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between">
        <div class="">
            <form id="limit" method="GET" action="{{ route('test2') }}">
                <select onchange="document.getElementById('limit').submit()" class="page_limit pgination-select" name="limit">
                    <option value="10" selected {{ request()->query("limit") == 10 ? 'selected' : '' }}>10 Entries per page</option>
                    <option value="20" {{ request()->query("limit") == 20 ? 'selected' : '' }}>20 Entries per page</option>
                    <option value="30" {{ request()->query("limit") == 30 ? 'selected' : '' }}>30 Entries per page</option>
                    <option value="50" {{ request()->query("limit") == 50 ? 'selected' : '' }}>50 Entries per page</option>
                </select>
            </form>
        </div>
        <div class="">
            {{$user->links('admin.paginate')}}
        </div>
    </div>
</div>




</body>
</html>
