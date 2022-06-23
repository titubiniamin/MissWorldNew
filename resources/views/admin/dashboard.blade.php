@extends('layouts.admin_app')
@section('main-content')
    @push('title')
        Dashboard
    @endpush
    <style>
        div.dataTables_filter input {
            border: 1px solid #645a5a;
        }
    </style>
    <div class="container-fluid">
        <div class="card">
            <h3 class="card-title text-success ml-4 mt-4" style="font-weight:bolder">Search</h3>
            <div class="row mt-3 ml-3 fluid">
                <div class="col-md-4 form-group ">
                    <div class="form-group">
                        <form action="" method="post">
                            @csrf
                            <label for="step_ID">Application Date From:</label>

                            <div class='input-group date' id='datetimepicker1'>
                                <input type='date' name="date_form" class="form-control"
                                       value="@if(isset($date_form) && $date_form != ''){{$date_form}}@endif"/>
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                            </div>
                    </div>

                </div>
                <div class="col-md-4">
                    <div class="form-group">

                        <label for="step_ID">Application Date To:</label>

                        <div class='input-group date' id='datetimepicker2'>
                            <input type='date' name="date_to" class="form-control"
                                   value="@if(isset($date_to) && $date_to != ''){{$date_to}}@endif"/>
                            <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-calendar"></span>
                                </span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row ml-3 fluid">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="step_ID">Filter Round Wise :</label>
                        <select class="form-control" id="step_ID" name="step_ID">
                            <option value="">All Round</option>
                            @foreach ($steps as $index=>$step )
                                <option value="{{$step->id}}"
                                        @if(isset($stepselect) == "" && $step->is_current == 1)
                                            selected
                                        @endif
                                        @if(isset($stepselect))
                                            @if($step->id == $stepselect)
                                                selected
                                    @endif
                                    @endif
                                >
                                    {{$step->step_name}}
                                </option>
                            @endforeach
                        </select>
                        <!--or-->
                        <!--<select class="form-control" id="reject_id" name="reject_id">-->
                        <!--                <option value="">Select Reject Steps</option>-->
                        <!--                @foreach ($steps as $index=>$rstep )-->
                        <!--                <option value="{{$rstep->id}}" @if(isset($rejectID))
                            @if($rstep->id == $rejectID)
                                selected














                            @endif
                        @endif>{{$rstep->step_name}}</option>-->
                        <!--                @endforeach-->
                        <!--</select>-->
                        <!-- <select class="form-control" id="result_status" name="result_status">-->
                        <!--<option value="">Select Status</option>-->
                        <!--  <option value="2" @if(isset($result_status) == 2)
                            selected














                        @endif>No Card</option>-->
                        <!-- <option value="1" @if(isset($result_status) == 1)
                            selected














                        @endif>Yes Card</option>-->
                        <!-- </select>-->
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="step_ID">District Wise :</label>
                        <select class="form-control" id="district_id" name="district_id">
                            <option value="">All District</option>
                            @foreach ($districts as $index=>$dis )
                                <option value="{{$dis->name}}"
                                        @if(isset($districtselect) && ($dis->name == $districtselect)) selected @endif>{{$dis->name}}</option>
                            @endforeach
                        </select>
                        <!--or-->
                        <!--<select class="form-control" id="reject_id" name="reject_id">-->
                        <!--                <option value="">Select Reject Steps</option>-->
                        <!--                @foreach ($steps as $index=>$rstep )-->
                        <!--                <option value="{{$rstep->id}}" @if(isset($rejectID))
                            @if($rstep->id == $rejectID)
                                selected














                            @endif
                        @endif>{{$rstep->step_name}}</option>-->
                        <!--                @endforeach-->
                        <!--</select>-->
                        <!-- <select class="form-control" id="result_status" name="result_status">-->
                        <!--<option value="">Select Status</option>-->
                        <!--  <option value="2" @if(isset($result_status) == 2)
                            selected














                        @endif>No Card</option>-->
                        <!-- <option value="1" @if(isset($result_status) == 1)
                            selected














                        @endif>Yes Card</option>-->
                        <!-- </select>-->
                    </div>
                </div>
                <div class="row ml-3 fluid">
                    <button id="submit-btn" data-toggle="modal" type="submit" value="0"
                            class="btn btn-success px-5 w-auto h-50 mt-4">
                        Search
                    </button>
                </div>
                </form>
            </div>
        </div>


        <div class="row">
            <div class="col-12 table-responsive" style=" background: white;">
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
                        <th>Current Step</th>
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
                        data: 'full_name',
                        name: 'full_name',
                    },
                    {
                        data: 'user.image_video.close_up_photo',
                        name: 'user.image_video.close_up_photo',
                        render: function (data) {
                            if (!data) return "<img src='{{asset('images/blank.png')}}' width='70' />"
                            return "<img src='{{asset('storage/')}}/applicant_image/" + data + "' width='70' />"
                        }
                    },
                    {
                        data: 'user.address', name: 'user.address',
                        render: function (data) {
                            // console.log('shuvo',data.upazilla == null ? '' : data.upazilla.name)
                            // data.upazilla && data.upazilla.name ? upazilla1=data.upazilla.name:upazilla1=""
                            // data.upazilla.district && data.upazilla.district ? district1=data.upazilla.district.name:district1=""

                            return `${data.address} \n
                            ${ data?.upazilla?.name ?? '' } \n
                            ${ data?.upazilla?.district?.name ?? '' } \n
                            ${ data?.upazilla?.district?.division?.name ?? '' } \n`;
                        }
                    },
                    {data: 'mobile_no', name: 'mobile_no'},
                    {data: 'user.email', name: 'user.email'},
                    {
                        data: 'date_of_birth', name: 'date of birth',
                        render: function (data) {
                            let birthday = +new Date(data);
                            return data + "<br>Age: " + ~~((Date.now() - birthday) / (31557600000));
                        }
                    },
                    {data: 'f_current_steps', name: 'f_current_steps',
                        render: function (data) {
                            return `
                            <select class="form-control" id="step_{{$val->Applicant_Id}}"  onchange="step_change({{$val->Applicant_Id}})">
                        <option value="">Change/Jump Next Round</option>
                        @foreach ($steps as $index=>$step )
                            @if($step->id >= $val->f_current_steps && $step->id < ($val->f_current_steps+2) )
                            <option value="{{$step->id}}" @if($step->id == $val->f_current_steps) selected @endif>{{$step->step_name}}</option>
                        @endif

                            @endforeach
                            </select>`;
                        }
                    },
                    {data: 'social_link', name: 'social_link'},
                    {data: 'height', name: 'height'},
                    {data: 'weight', name: 'weight'},
                    {
                        data: 'user.image_video.video', name: 'video',
                        render: function (data) {
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
