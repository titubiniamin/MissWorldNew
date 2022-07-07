@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table  table-bordered user_datatable">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Video</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Occupation</th>
                        <th>Date of birth</th>
                        <th>Age</th>
                        <th>Address</th>
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
                    {data: 'photo', name: 'photo'},
                    {data: 'video', name: 'video'},
                    {data: 'mobile', name: 'mobile'},
                    {data: 'email', name: 'email'},
                    {data: 'occupation', name: 'occupation'},
                    {data: 'date-of-birth', name: 'date-of-birth'},
                    {data: 'age', name: 'age'},
                    {data: 'address', name: 'address'},
                    {data: 'step', name: 'step'},
                    {data: "step_change", title: "Step Change", searchable: true, orderable: true},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });
        });

        function getSteps(){

            // let step = document.getElementById('step').value
            let step2=document.querySelector('#step')
            console.log(step2.value)
            $.ajax({
                url: `/admin/step-change/${step}`,
                type:'GET',
                dataType: 'JSON',
                success:function(data){
                    console.log(data)
                },
                error: function(err){
                    console.log(err)
                }
            })
        }
    </script>
@endsection
