@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush
    <div class="container-fluid">
        <div class="row">
            @include('admin.participant_filter')
            <div class="form-group">

                <select name="filter_country" id="filter_country">
                    <option value="">All</option>
                    @foreach($customer_name as $step)
                        <option value="{{$step->f_current_steps}}">{{$step->f_current_steps}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <button type="button" name="filter" id="filter">Filter</button>
            </div>

            <div class="table-responsive">
                <table class="table  table-bordered user_datatable" id="customer_data">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Video</th>
                        <th>Height</th>
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
<script>
    $(document).ready(function(){
        fill_datatable()
        function fill_datatable(round='',height='',district='',startDate='',endDate='',photoStatus='',applicationStatus=''){
            var dataTable=$('#customer_data').DataTable({
                processing:true,
                serverSide:true,
                ajax:{
                    url:"{{route('admin.dashboard')}}",
                    data: {round:round,height:height,district:district,startDate:startDate,endDate:endDate,photoStatus:photoStatus,applicationStatus:applicationStatus}
                },
                columns:[

                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'photo', name: 'photo'},
                    {data: 'video', name: 'video'},
                    {data: 'height', name: 'height'},
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
        }

        $('#reset').click(function(){
            location.reload()
        })

        $('#search-applicant').click(function(){
            var round=$('#round').val();
            var height=$('#height').val()
            var district=$('#district').val()
            var startDate=$('#txtstartdate').val()
            var endDate=$('#txtenddate').val()
            var photoStatus=$('input[name=photo_status]:checked').val()
            let applicationStatus = $('input[name=application_status]:checked').val()

            // var photoStatus=$('#photo_status').val()


            console.log('variable Shuvo','round'+round,'height'+height,'dist'+district,'start'+startDate,'end'+endDate,'photo'+photoStatus,'applicationStatus'+applicationStatus)
                $('#customer_data').DataTable().destroy();
                fill_datatable(round,height,district,startDate,endDate,photoStatus,applicationStatus);

        })
    })

    function getSteps(e, id) {
        Swal.fire({
            title: 'Are you Sure to Change round?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes !'
        }).then((result) => {
            if (result.isConfirmed) {
                let step2 = document.querySelector('#step')
                // console.log(step2.value)
                $.ajax({
                    url: `/admin/step-change/${step2.value}/${id}`,
                    type: 'GET',
                    dataType: 'JSON',
                    success: function (res) {   // success callback// function
                        console.log(e.target.selectedOptions[1])
                        $(`#step-${id}`).text(e.target.selectedOptions[0].text)
                        Toast.fire({
                            icon: 'success',
                            title: res.message
                        })
                    },
                    error: function (errorMessage) { // error callback
                        console.log('Error: ' + errorMessage);
                        Toast.fire({
                            icon: 'error',
                            title: errorMessage
                        })
                    }
                })
            }
        })




    }

    const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
    })

</script>
@endsection
