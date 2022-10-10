@extends('layouts.admin_app')
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css"
      integrity="sha512-vKMx8UnXk60zUwyUnUPM3HbQo8QfmNx7+ltw8Pm5zLusl1XIfwcxo8DbWCqMGKaWeNxWA8yrx5v3SaVpMvR3CA=="
      crossorigin="anonymous" referrerpolicy="no-referrer"/>
@section('main-content')
    @push('title')
        Dashboard
    @endpush
    @include('admin.participant_filter')

    <div class="container-fluid">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table  table-bordered user_datatable" id="user_datatable">
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
        <script>
            console.log('hello');
        </script>

    <script type="text/javascript">
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

        $(function () {
            fillDatatable()
            function fillDatatable(round='') {
                console.log('called',round)
                var table = $('#user_datatable').DataTable({
                    "pageLength": 10,
                    responsive: true,
                    serverSide: true,
                    processing: true,
                    ajax: "{{ route('admin.dashboard') }}",
                    data: {round:round},
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
                    ],

                });
            }

          $('#search-applicant').click(function () {
              console.log('aaaaaaaaaaaaaaaaaaaaa')
          })

            // $('#search-applicant').click(function(){
            //     console.log('search clicked')
            //     //startDate:startDate,endDate:endDate,height:height,district:district,round:round
            //     var startDate=$('#startDate').val()
            //     let endDate=$('#endDate').val()
            //     let height=$('#height').val()
            //     let district=$('#district').val()
            //     let round=$('#round').val()
            //     if(round != ''){
            //         console.log('not null district')
            //         $('#user_datatable').DataTable().destroy();
            //         // $('#txtstartdate').val("GeeksForGeeks");
            //         fillDatatable(round)
            //     }else {
            //         alert('fill round')
            //     }
            //
            // })

        });



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

            // console.log('id',id)
            // if(confirm('Are you Sure to Change round?')){
            //     let step2=document.querySelector('#step')
            //      // console.log(step2.value)
            //     $.ajax({
            //         url: `/admin/step-change/${step2.value}/${id}`,
            //         type:'GET',
            //         dataType: 'JSON',
            //         success: function (res) {   // success callback function
            //             console.log('success',res)
            //             // alert(success)
            //             // toastr.success(data.success)
            //         },
            //         error: function (errorMessage) { // error callback
            //             console.log('Error: ' + errorMessage);
            //         }
            //     })
            // }else{
            //     return 0;
            // }


        }
    </script>


@endsection
