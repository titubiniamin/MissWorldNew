@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush

    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered user_datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Step</th>
                        <th>Step Change</th>
                        <th width="100px">Action</th>
                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $(function () {
            var table = $('.user_datatable').DataTable({
                "pageLength": 10,
                stateSave: true,
                responsive: true,
                serverSide: true,
                processing: true,
                ajax: "{{ route('admin.dashboard') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'step', name: 'step'},
                    {data: "step_change", title: "Step Change", searchable: true, orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });
    </script>
@endsection
