@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush
{{--    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">--}}
{{--@dd($applicants)--}}
    <style>
        #example_info{display: none}
        #example_paginate{visibility: hidden}


    </style>
<div class="container-fluid">
    <div class="card">
    <div class="row">
        <div class="col-md-12">
            <div class="">
                <form id="limit" method="GET" action="{{ route('admin.dashboard') }}">
                    <select class="form-control col-2" onchange="document.getElementById('limit').submit()" class="page_limit pgination-select" name="limit">
                        <option value="10" selected {{ request()->query("limit") == 10 ? 'selected' : '' }}>10 Entries per page</option>
                        <option value="20" {{ request()->query("limit") == 20 ? 'selected' : '' }}>20 Entries per page</option>
                        <option value="30" {{ request()->query("limit") == 30 ? 'selected' : '' }}>30 Entries per page</option>
                        <option value="50" {{ request()->query("limit") == 50 ? 'selected' : '' }}>50 Entries per page</option>
                    </select>
                </form>

            </div>
            <table id="example" class="display  table table-responsive ml-5" style="max-width: 90%!important;">
                <thead style="max-width: 100%!important;">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Apply Date</th>
                    <th>Name</th>
                    <th>DOB</th>
                </tr>
                </thead>
                <tbody style="max-width: 100%!important;">
                @foreach($applicants as $applicant)
                    @php
                        $limit = request()->query("limit")?request()->query("limit"):'';
                        $page=request()->query("page")?request()->query("page"):'';
                    @endphp
                <tr>
                    <th>{{ $loop->iteration + ($limit && $page ? ($limit * ($page - 1 )) : 0 )}}</th>
                    <td>{{$applicant->first_name}}</td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    </div>

    <div class="d-flex justify-content-between">

        <div class="">
            {{$applicants->links('admin.paginate')}}
        </div>
    </div>

</div>

@endsection
