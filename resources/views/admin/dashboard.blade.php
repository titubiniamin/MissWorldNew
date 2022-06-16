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
                        <th>Address</th>
                        <th>Mobile</th>
                        <th>Email</th>
                        <th>Date of Birth</th>
                        <th>Social link</th>
                        <th>Height</th>
                        <th>Weight</th>
                        <th>Video</th>
                        <th width="100px">Action</th>
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
                ajax: "{{ route('admin.dashboard') }}",
                columns: [
                    {data: 'id', name: 'id'},
                    {
                        data : 'full_name',
                        name: 'full name',
                    },
                    {
                        data: 'user.image_video.close_up_photo',
                        name: 'photo',
                        render: function (data) {
                            return "<img src='{{asset('storage/')}}/applicant_image/" + data + "' width='70' />"
                        }
                    },
                    {
                        data: 'user.address', name: 'address',
                        render: function (data) {
                            return data.address + "<br>" + data.upazilla.name + ' ' + data.upazilla.district.name + ' ' + data.upazilla.district.division.name
                        }
                    },
                    {data: 'mobile_no', name: 'mobile'},
                    {data: 'user.email', name: 'email'},
                    {data: 'date_of_birth', name: 'date of birth',
                    render:function(data){
                        let birthday = +new Date(data);
                        return data+"<br>Age: "+ ~~((Date.now() - birthday) / (31557600000));
                    }
                    },
                    {data: 'social_link', name: 'social link'},
                    {data: 'height', name: 'height'},
                    {data: 'weight', name: 'weight'},
                    {data: 'user.image_video.video', name: 'video',
                    render:function(data){
                        return `<video controls   width="200" height="140" poster=""  id="video_preview_main">
                         <source id="video_preview"  src="{{asset('storage/applicant_video/${data}')}}" type="video/mp4">
                                </video>`;
                    }
                    },
                    // {data: 'user.address.upazilla.district.division.name', name: 'name'},
                    // {data: 'email', name: 'email'},
                    {
                        data: 'action', name: 'action',
                        orderable: false,
                        searchable: false
                    },
                ]
            });
        });
    }, 1000)
</script>

