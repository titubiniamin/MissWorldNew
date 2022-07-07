@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered user_datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Photo</th>

                    </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
<script type="text/javascript">
    setTimeout(() => {
        $(function () {
            var table = $('.user_datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.getData') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data : 'full_name', name: 'full name',
                    },
                    {data: 'mobile_no', name: 'mobile'},
                    {data: 'f_current_steps', name: 'round'},
                    // {data: 'user.address.upazilla.district.division.name', name: 'name'},
                    // {data: 'email', name: 'email'},

                ]
            });
        });
    }, 1000)
</script>

