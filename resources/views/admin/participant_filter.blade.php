<link rel="stylesheet" type="text/css"
      href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/themes/redmond/jquery-ui.css">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.4/jquery-ui.js"></script>
<div class="container">
    <div class="card">
        <div class="card-body">
            <h3>Search Applicants</h3>

{{--            <form action="{{ route('admin.dashboard') }}" method="GET">--}}
                <div class="row">
                    <div class="form-group col-md-3">
                        <label for="date">{{__('Application Start Date')}}</label>
                        <input name="startDate" value="{{ request()->query('startDate')}}" id="txtstartdate" class="form-control"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="date">{{__('Application End Date')}}</label>

                        <input name="endDate" value="{{ request()->query('startDate')}}" class="form-control" id="txtenddate"/>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="height">{{ __('Height (Feet)') }}</label>
                        <div class="">

                            @php
                                $heights=["5.1","5.2","5.3","5.4","5.5","5.6","5.7","5.8","5.9","5.10","5.11","6.0","6.1", "6.2","6.3","6.4","6.5","6.6","6.7","6.8","6.9","6.10","6.11","7.0"]
                            @endphp
                            <select class="form-control @error('height') is-invalid @enderror" name="height"
                                    id="height">
                                <option value="">Any Height</option>
                                @foreach($heights as $height)
                                    @if(!empty( request()->query('height')) &&  request()->query('height')==$height)
                                        @php $selected='selected' @endphp
                                    @else
                                        @php $selected=''; @endphp
                                    @endif
                                    <option
                                        value="{{$height}}"
                                        {{$selected??''}} {{ request()->query('height')==$height ? "selected":null}}>{{$height}}</option>
                                @endforeach
                            </select>
                            @error('height')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="district">{{ __('District') }} </label>

                        <div class="">

                            <select class="form-control @error('district') is-invalid @enderror" name="district"
                                    id="district">
                                <option value="">All Districts</option>
                                @foreach($districts as $district)
                                    <option
                                        value="{{$district->id}}"
                                        {{$selected??''}} {{ request()->query('district') &&  request()->query('district')==$district->id ? "selected":null}}>{{$district->name}}</option>
                                @endforeach
                            </select>
                            @error('height')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row">

                    <div class="form-group col-md-3">
                        <label for="round">{{ __('Round') }} </label>

                        <div class="">
{{--                        {{dd(request())}}--}}
                            <select class="form-control @error('round') is-invalid @enderror" name="round"
                                    id="round">
                                <option value="">All Round</option>
                                @foreach($rounds as $round)
                                    <option
                                        value="{{$round->id}}"
                                        {{$selected??''}} {{ request()->query('round')==$round->id ? "selected":null}}>{{$round->step_name}}</option>
                                @endforeach
                            </select>
                            @error('height')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group md-col-3">
                        <label for="date">{{__('Final Submission(With Photo)')}}</label>
                        <div class="btn-group form-control" role="group" aria-label="Basic outlined example">
                            <input type="radio" value="1"
                                   {{request()->query('photo_status') =="1" ? 'checked':''}} id="photo_status" name="photo_status"
                                   class="btn btn-outline-primary btn-group-vertical ml-3"> Yes</input>
                            <input type="radio" value="0"
                                   {{request()->query('photo_status') =="0" ? 'checked':''}} id="photo_status" name="photo_status"
                                   class="btn btn-outline-primary btn-group-vertical ml-3"> No</input>
                            <input type="radio" value="2"
                                   checked id="photo_status" name="photo_status"
                                   class="btn btn-outline-primary btn-group-vertical ml-3"> Any</input>
                            {{--                            <input type="radio" value="No" {{ request()->query('photo_status.1')=="No" ? 'checked':''}} name="photo_status[]" class="btn btn-outline-primary btn-group-vertical ml-3">No</input>--}}
                            {{--                            <input type="radio" value="Any" {{ request()->query('photo_status.2')=="Any" ? 'checked':''}} name="photo_status[]" class="btn btn-outline-primary btn-group-vertical ml-3">Any</input>--}}
                        </div>
                    </div>
                    <div class="form-group md-col-3 ml-3">
                        <label for="date">{{__('Application Status')}}</label>
                        <div class="btn-group form-control" role="group" aria-label="Basic outlined example">
                            <input type="radio" id="application_status" value="0" name="application_status"
                                   class="btn btn-outline-primary btn-group-vertical"> Draft</input>
                            <input type="radio" id="application_status" value="1" name="application_status"
                                   class="btn btn-outline-primary btn-group-vertical ml-3"> Final</input>
                            <input type="radio" id="application_status" checked value="" name="application_status"
                                   class="btn btn-outline-primary btn-group-vertical ml-3"> Any</input>
                        </div>
                    </div>

                </div>

                <div class="form-group">
                    <button id="search-applicant"
                            type="button" value="0" class="btn btn-success px-5">
                        {{ __('Search') }}
                    </button>
                    <button id="reset" data-toggle="modal"
                            type="button" value="0" class="btn btn-danger px-5">
                        {{ __('Reset') }}
                    </button>
                </div>
{{--            </form>--}}
        </div>
    </div>
</div>
<script>
    // $("#txtstartdate").datepicker({
    //     yearRange: '2021:2022',
    //     dateFormat: "yy-mm-dd",
    //     onSelect: function (date) {
    //         $("#txtstartdate").datepicker('option', 'minDate', date);
    //     }
    // });
    $("#txtstartdate").datepicker({
        dateFormat: "yy-mm-dd",
        onSelect: function(date) {
            $("#txtenddate").datepicker('option', 'minDate', date);
        }
    });

    $("#txtenddate").datepicker({
        dateFormat: "yy-mm-dd"
    });
</script>
