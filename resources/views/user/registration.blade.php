@extends('layouts.user_app')
@push('title')
    Registration
@endpush
@section('main-content')
    <style>
        .left {
            float: left;
        }

        span[dir="select2-data-4-yy2t"] {
            width: -webkit-fill-available;
            background-color: red;
        }

        .select2-selection--multiple{
            min-height: 45px!important;
            background-color: #f8fafc;!important;
            width: 100%!important;
        }
    </style>
    <div class="container">
        <div class="card ">
            <div class="card-body">
                <h3 class="card-title text-success " style="font-weight:bolder">Pageant Registration</h3>
                <form action="{{ route('applicant.register') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label text-md-right">{{ __('First Name') }}<span
                                    class="text-danger">*</span></label>

                            <div class="">
                                <input type="hidden" value="{{Request::ip()}}" name="ip_address">
                                <input type="hidden" value="{{Request::header('User-Agent')}}" name="browser_info">

                                <input id="First_Name" type="text"
                                       class="form-control @error('first_name') is-invalid @enderror"
                                       name="first_name"
                                       value="{{ $mwApplicant ? $mwApplicant['first_name'] ?? '' :  old('first_name') }}"
                                       autocomplete="name" autofocus>

                                @error('first_name')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Last Name" class="col-form-label">{{ __('Last Name') }}<span
                                    class="text-danger">*</span></label>
                            <input id="last_name" type="text"
                                   class="form-control @error('last_name') is-invalid @enderror"
                                   name="last_name"
                                   value="{{ $mwApplicant ? $mwApplicant->last_name ?? '' :  old('last_name') }}"
                                   autocomplete="last_name">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                        <!----------Row End---------->

                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label text-md-right">{{ __('Date of Birth') }}
                                <span class="text-danger">*</span></label>

                            <div class="">
                                <input id="date_of_birth" type="date" min="1995-01-01" max="2004-12-31"
                                       class="form-control @error('date_of_birth') is-invalid @enderror"
                                       name="date_of_birth"
                                       value="{{ $mwApplicant ? $mwApplicant->date_of_birth ?? '':old('date_of_birth') }}"
                                       autocomplete="date_of_birth" autofocus>

                                @error('date_of_birth')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="phone" class="col-form-label">{{ __('Mobile Number') }}<span
                                    class="text-danger">*</span></label>
                            <input id="mobile_no" type="tel" placeholder="01911515151"
                                   class="form-control @error('mobile_no') is-invalid @enderror"
                                   name="mobile_no"
                                   value="{{ $mwApplicant ? $mwApplicant->mobile_no ?? '' :  old('mobile_no') }}"
                                   autocomplete="mobile_no">
                            <!--pattern="01[56789]{1}[0-9]{8}"-->
                            @error('mobile_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <!----------Row Start---------->

                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="height" class="col-form-label text-md-right">{{ __('Height (Feet)') }}
                                <span
                                    class="text-danger">*</span></label>

                            <div class="">

                                @php
                                    $heights=["5.1","5.2","5.3","5.4","5.5","5.6","5.7","5.8","5.9","5.10","5.11","6.0","6.1", "6.2","6.3","6.4","6.5","6.6","6.7","6.8","6.9","6.10","6.11","7.0"]
                                @endphp
                                <select class="form-control @error('height') is-invalid @enderror" name="height"
                                        id="height">
                                    <option value="">Select Height</option>
                                    @foreach($heights as $height)
                                        @if(!empty($mwApplicant) && $mwApplicant->height==$height)
                                            @php $selected='selected' @endphp
                                        @else
                                            @php $selected=''; @endphp
                                        @endif
                                        <option
                                            value="{{$height}}"
                                            {{$selected??''}} {{old('height')==$height ? "selected":null}}>{{$height}}</option>
                                    @endforeach
                                </select>
                                @error('height')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="weight" class="col-form-label">{{ __('Weight(KG)') }}<span
                                    class="text-danger">*</span></label>
                            <input id="weight" placeholder="50.5" type="text"
                                   class="form-control @error('weight') is-invalid @enderror" name="weight"
                                   value="{{ $mwApplicant && $mwApplicant->weight?$mwApplicant->weight:old('weight') }}"
                                   autocomplete="weight">
                            @error('weight')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <!----------Row Start---------->
                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="nid" class="col-form-label text-md-right">{{ __('National ID') }}<span
                                    class="text-danger">*</span></label>

                            <div class="">
                                <input id="nid" type="number"
                                       class="form-control @error('nid') is-invalid @enderror" name="nid"
                                       value="{{$mwApplicant ? $mwApplicant->nid??'': old('nid') }}"
                                       autocomplete="nid" autofocus>

                                @error('nid')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Passport_no" class="col-form-label">{{ __('Passport No') }}<span
                                    class="text-danger">*</span></label>
                            <input id="passport_no" type="text"
                                   class="form-control @error('passport_no') is-invalid @enderror"
                                   name="passport_no"
                                   value="{{$mwApplicant?$mwApplicant->passport_no??'': old('passport_no') }}"
                                   autocomplete="passport_no">
                            @error('passport_no')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror

                        </div>
                        <!----------Row Start---------->
                        <!----------Row Start---------->

                        <div class="form-group col-md-6">
                            <label for="Upload Mid Shot Photo"
                                   class="col-form-label">{{ __('Upload Close Up Photo') }}<span
                                    class="text-danger">*</span></label>
                            <div class="side_view">


                            </div>
                            <img width="150" height="150" id="close_up_photo_preview"
                                 src="{{$mwApplicantImageVidoes && $mwApplicantImageVidoes->close_up_photo? asset('storage/applicant_image/'.$mwApplicantImageVidoes->close_up_photo):asset('images/blank.png')}}">
                            <input accept="image/*" id="close_up_photo" type="file"
                                   class="form-control @error('close_up_photo') is-invalid @enderror"
                                   name="close_up_photo"
                                   value="{{$mwApplicant?$mwApplicant->close_up_photo??'': old('close_up_photo') }}"
                                   autocomplete="close_up_photo">

                            @error('close_up_photo')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <div class="form-group col-md-6">
                            <label for="Upload Mid Shot Photo"
                                   class="col-form-label">{{ __('Upload Mid Shot Photo') }}<span
                                    class="text-danger">*</span></label>
                            <div class="side_view">


                            </div>
                            <img width="150" height="150" id="mid_shot_photo_preview"
                                 src="{{$mwApplicantImageVidoes && $mwApplicantImageVidoes->mid_shot_photo? asset('storage/applicant_image/'.$mwApplicantImageVidoes->mid_shot_photo):asset('images/blank.png')}}">
                            <input accept="image/*" id="mid_shot_photo" type="file"
                                   class="form-control @error('mid_shot_photo') is-invalid @enderror"
                                   name="mid_shot_photo"
                                   value="{{$mwApplicant?$mwApplicant->mid_shot_photo??'': old('mid_shot_photo') }}"
                                   autocomplete="mid_shot_photo">

                            @error('mid_shot_photo')
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                            @enderror

                        </div>
                        <!----------Row Start---------->
                        <!----------Full Length Photo---------->
                        <div class="form-group col-md-6">
                            <label for="Upload Full Length Photo"
                                   class="col-form-label text-md-right">{{ __('Upload Full Length Photo') }}
                                <span class="text-danger">*</span></label>

                            <div class="">
                                <img height="150" width="150" id="full_length_photo_preview"
                                     src="{{ $mwApplicantImageVidoes && $mwApplicantImageVidoes->full_length_photo  ? asset('storage/applicant_image/'.$mwApplicantImageVidoes->full_length_photo)  : asset('images/blank.png')}}">
                                <input id="full_length_photo" type="file"
                                       class="form-control @error('full_length_photo') is-invalid @enderror"
                                       name="full_length_photo"
                                       value="{{$mwApplicantImageVidoes ? $mwApplicantImageVidoes->full_length_photo??'': old('full_length_photo') }}"
                                       autocomplete="full_length_photo" autofocus>

                                @error('full_length_photo')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Upload Video"
                                   class="col-form-label text-md-right">{{ __('Upload Video') }}
                                <span class="text-danger">*</span></label>
                            <div class="">
                                <video
                                    controls
                                    width="200"
                                    height="140"
                                    poster=""
                                    id="video_preview_main"
                                >

                                    <source id="video_preview"
                                            src="{{$mwApplicantImageVidoes && $mwApplicantImageVidoes->video?asset('storage/applicant_video/'.$mwApplicantImageVidoes->video):asset('')}}"
                                            type="video/mp4">
                                </video>

                                <input id="video" type="file"
                                       class="form-control @error('video') is-invalid @enderror"
                                       name="video"
                                       value="{{$mwApplicantImageVidoes ? $mwApplicantImageVidoes->video??'': old('video') }}"
                                       autocomplete="video" autofocus>

                                @error('video')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <!----------Row Start---------->
                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="Division" class="col-form-label text-md-right">{{ __('Division') }}<span
                                    class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control @error('division_id') is-invalid @enderror"
                                        name="division_id" id="division_id" onchange="getDistricts(this.value)">
                                    <option value="" disabled selected>Select Division</option>
                                    @foreach($divisions as $division)
                                        <option
                                            value="{{$division->id}}" {{  !empty($mwApplicantAddress) && $division->id == $mwApplicantAddress->division_id ? 'selected': (old('division_id')==$division->id?'selected':null) }}>{{$division->name}}</option>
                                    @endforeach
                                </select>

                                @error('division_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="District" class="col-form-label text-md-right">{{ __('District') }}<span
                                    class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control @error('division') is-invalid @enderror"
                                        name="district_id" id="district_id" onchange="getUpazillas(this.value)">
                                    <option value="" disabled selected>Select District</option>
                                </select>

                                @error('district_id')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <!----------Row Start---------->
                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="Upazilla" class="col-form-label text-md-right">{{ __('Upazilla') }}<span
                                    class="text-danger">*</span></label>
                            <div class="">
                                <select class="form-control @error('upazilla_id') is-invalid @enderror"
                                        name="upazilla_id" id="upazilla_id">
                                    <option value="" disabled selected>Select Upazilla</option>

                                </select>

                                @error('upazilla_id')
                                <span class="invalid-feedback" role="alert">
{{--                                    <strong>{{ $message }}</strong>--}}
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="address" class="col-form-label">{{ __('Address') }}<span
                                    class="text-danger">*</span></label>
                            <textarea rows="3" id="address" rows="1"
                                      class="form-control @error('address') is-invalid @enderror"
                                      name="address"
                                      autocomplete="address"
                                      placeholder="">{{ $mwApplicant ? $mwApplicantAddress->address ?? '' :  old('address') }}</textarea>
                            @error('address')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>

                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="occupation" class="col-form-label text-md-right">{{ __('Occupation') }}
                                <span
                                    class="text-danger">*</span></label>

                            <div class="">
                                @php
                                    $occupationLists=['Artist','Business','Construction worker','Designer','Entrepreneur','Freelancer','Social worker','Shef','Student','Other','House Wife','Unemployed','Actress'];
                                    sort($occupationLists);

                                @endphp
                                <select class="form-control @error('height') is-invalid @enderror"
                                        name="occupation"
                                        id="occupation">

                                    <option disabled selected value="">Select Occupation</option>
                                    @foreach($occupationLists as $occupation)
                                        <option
                                            value="{{$occupation}}" {{!empty($mwApplicant) && $mwApplicant->occupation==$occupation?'selected':(old('occupation')==$occupation?'selected':null)}} >
                                            {{$occupation}}</option>
                                    @endforeach
                                </select>

                                @error('occupation')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="talent" class="col-form-label">{{ __('Talent') }}<span
                                    class="text-danger">*</span></label>
                            {{--                                    <input id="prompt" class="prompt" type="text" placeholder="Search countries...">--}}
                            @php
                                $talents = ['Music','Acting','Dancing','Recitation','Writing','Other'];
                            @endphp
                            <select class="js-example-basic-multiple w-100" name="talent[]" multiple="multiple" style="width: 100%!important;background-color: #f8fafc!important; min-height: 45px!important;">
                                @foreach($talents as $talent)
                                    @php $selected = '';  @endphp
                                    @if(!empty($mwApplicant->talent))
                                        @foreach ($mwApplicant->talent as $previousTalent)
                                            @php  if($previousTalent == $talent) $selected = 'selected'; @endphp
                                        @endforeach
                                    @endif
                                    <option value="{{$talent}}" {{ $selected }}>{{$talent}}</option>
                                @endforeach
                            </select>
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                            @enderror

                        </div>
                        <!----------Row End---------->
                        <!--Row Start-->
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label text-md-right">{{ __('Other Talent') }}<span
                                    class="text-danger">*</span></label>

                            <div class="">
                                <input id="talent_other" type="text"
                                       class="form-control @error('talent_other') is-invalid @enderror"
                                       name="talent_other"
                                       value="{{ $mwApplicant ? $mwApplicant['talent_other'] ?? '' :  old('talent_other') }}"
                                       autocomplete="name" autofocus>

                                @error('talent_other')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="habits" class="col-form-label">{{ __('Hobby') }}<span
                                    class="text-danger">*</span></label>
                            <input id="habits" type="text"
                                   class="form-control @error('habits') is-invalid @enderror"
                                   name="habits"
                                   value="{{ $mwApplicant ? $mwApplicant->habits ?? '' :  old('habits') }}"
                                   autocomplete="habits">
                            @error('habits')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                        <!--Row End-->
                        <!--Row Start-->
                        <div class="form-group col-md-6">
                            <label for="tell_us"
                                   class="col-form-label text-md-right">{{ __('Tell us your life\'s objective\'s') }}
                                <span
                                    class="text-danger">*</span></label>

                            <div class="">
                                        <textarea id="tell_us" rows="1"
                                                  class="form-control @error('tell_us') is-invalid @enderror"
                                                  name="tell_us"
                                                  autocomplete="tell_us"
                                                  placeholder="">{{ $mwApplicant ? $mwApplicant->tell_us ?? '' :  old('tell_us') }}</textarea>

                                @error('tell_us')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="why_participate"
                                   class="col-form-label">{{ __('Why you are participating') }}<span
                                    class="text-danger">*</span></label>
                            <textarea rows="3" id="why_participate" rows="1"
                                      class="form-control @error('why_participate') is-invalid @enderror"
                                      name="why_participate"
                                      autocomplete="why_participate"
                                      placeholder="">{{ $mwApplicant ? $mwApplicant->why_participate ?? '' :  old('why_participate') }}</textarea>
                            @error('why_participate')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                        <!--Row End-->
                        <!--Row Start-->
                        <div class="form-group col-md-6">
                            <label for="beauty_purpose"
                                   class="col-form-label text-md-right">{{ __('Beauty with a purpose') }}<span
                                    class="text-danger">*</span></label>

                            <div class="">
                                        <textarea rows="3" id="beauty_purpose" rows="1"
                                                  class="form-control @error('beauty_purpose') is-invalid @enderror"
                                                  name="beauty_purpose"
                                                  autocomplete="beauty_purpose"
                                                  placeholder="">{{ $mwApplicant ? $mwApplicant->beauty_purpose ?? '' :  old('beauty_purpose') }}</textarea>

                                @error('tell_us')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="social_link" class="col-form-label">{{ __('Social Link') }}<span
                                    class="text-danger">*</span></label>
                            <textarea rows="3" placeholder="Your Facebook/Social Profile Link
" id="social_link" rows="1"
                                      class="form-control @error('social_link') is-invalid @enderror"
                                      name="social_link"
                                      autocomplete="why_participate"
                                      placeholder="">{{ $mwApplicant ? $mwApplicant->social_link ?? '' :  old('social_link') }}</textarea>
                            @error('social_link')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                        <!--Row End-->
                        <!----------Row Start---------->
                        <div class="form-group col-md-6">
                            <label for="name" class="col-form-label text-md-right">{{ __('Country Visited') }}
                                <span
                                    class="text-danger">*</span></label>

                            <div class="">

                                <select class="js-example-basic-multiple w-100 form-control" name="country_visited[]"
                                        multiple="multiple" style="width: 100%!important;background-color: #f8fafc!important; min-height: 45px!important;">
                                    @foreach($countries as $country)
                                        @php $selected = '';  @endphp
                                        @if(!empty($mwApplicant->country_visited))
                                            @foreach ($mwApplicant->country_visited as $previousCountry)
                                                @php  if($previousCountry== $country->name) $selected = 'selected'; @endphp
                                            @endforeach
                                        @endif
                                        <option
                                            value="{{$country->name}}" {{ $selected }}>{{$country->name}}</option>
                                    @endforeach
                                </select>

                                @error('country_visited')
                                <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="email" class="col-form-label">{{ __('Email') }}<span
                                    class="text-danger">*</span></label>
                            <input id="email" type="text"
                                   class="form-control @error('email') is-invalid @enderror "
                                   name="email"
                                   value="{{Auth::user()->email}}"
                                   autocomplete="email">
                            @error('last_name')
                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                            @enderror

                        </div>
                        <!----------Row End---------->
                    </div>
                    <div class="form-element-html">
                        <div>
                            <div class="oneLineText-cover field-cover">
                                <div class="form-check"><span class="error"></span>
                                    <input type="checkbox" class="form-check-input" id="confirm" required=""
                                           name="confirm"
                                           style="border-radius:0px"> I agree to the <a href="#">Terms &amp;
                                        Condition</a>.
                                    I hereby affirm that, the information provided above are authentic and that I have
                                    the
                                    full consent of my legal guardian(s)
                                    to participate in this pageant and that I am submitting this form under no juries
                                    and of
                                    my free will.
                                    <p style="color:red">
                                        After final submission you will be eligible for Miss World Bangladesh 2022. You
                                        can
                                        save a draft of the form before submission. After completing all the required
                                        fields, press the <strong>Final Submit</strong> button.

                                    </p>
                                    <p style="color:red; font-size:18px;">Note: After pressing the Final Submit button,
                                        you
                                        can no longer make changes to your profile. </p>
                                    <i class="no-icon"></i></div>
                            </div>
                        </div>
                    </div>
                    <!----------Button------------------>
                    <!--For Draft and Final submission Button value is assigned as default mail_status=0 so assigned final button as mail_status=1----->
                    @if(empty($mwApplicant) || $mwApplicant->mail_status != 1)
                        <div class="d-flex justify-content-between">
                            <div class="form-group">
                                    <button id="submit-btn" value="1" data-toggle="modal"
                                            type="submit" name="mail_status" class="btn btn-danger px-5">
                                        {{ __('Final') }}
                                    </button>
                            </div>
                            <div class="form-group">
                                <button id="submit-btn" data-toggle="modal"
                                        type="submit" value="0" class="btn btn-success px-5">
                                    {{ __('Draft') }}
                                </button>
                            </div>
                        </div>
                    @else
                        <div class="text-success"><h3>You have final submitted the form</h3></div>
                    @endif
                    <!----------Button------------------>


                </form>


                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                     aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered d-flex justify-content-center">
                        <img src="{{ asset('images/spinner.gif') }}">
                    </div>
                </div>
            </div>


            <script type="text/javascript">
                $('input[type="checkbox"]').on('change', function (e) {
                    if (e.target.checked) {
                        $('#submit-btn').attr('data-target', '#exampleModal');
                    } else $('#submit-btn').removeAttr('data-target')
                });
                $('.js-example-basic-multiple').select2();


                mid_shot_photo.onchange = () => {
                    const [file] = mid_shot_photo.files
                    if (file) {
                        mid_shot_photo_preview.src = URL.createObjectURL(file)
                    }
                }

                close_up_photo.onchange = () => {
                    const [file] = close_up_photo.files
                    if (file) {
                        close_up_photo_preview.src = URL.createObjectURL(file)
                    }
                }

                full_length_photo.onchange = () => {
                    const [file] = full_length_photo.files
                    if (file) {
                        full_length_photo_preview.src = URL.createObjectURL(file)
                    }
                }

                video.onchange = () => {
                    const [file] = video.files
                    if (file) {
                        video_preview_main.src = URL.createObjectURL(file)
                    }
                }


                function getDistricts(value_division_id) {
                    let districtDiv = $('#district_id');
                    // console.log(3);
                    let upazillaDiv = $('#upazilla_id')
                    upazillaDiv.html('');
                    let currentDistrict = "{{$mwApplicantAddress ? $mwApplicantAddress->district_id ?? $mwApplicantAddress->district_id :null}}";
                    let selected = "";
                    $.ajax({
                        url: `/get-district/${value_division_id}`, //  url: '/get-district/'+ event.value,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (data) {
                            console.log(data);
                            let selectOption = [];
                            data.forEach(function (district) {
                                // console.log(district);
                                if (currentDistrict == district.id) {
                                    selected = "selected"
                                }
                                selectOption.push(`<option ${selected} value="${district.id}">${district.name}</option>`);
                                selected = "";
                            })

                            districtDiv.html('');
                            districtDiv.html(selectOption);
                        },
                        error: function (ts) {
                            alert(ts.responseText)
                        }
                    })
                }

                let division = "{{ $mwApplicantAddress ? $mwApplicantAddress->division_id : null }}";
                setTimeout(() => {
                    if (division) getDistricts(division);
                }, 500)

                function getUpazillas(value_district_id) {
                    let upazillaDiv = $('#upazilla_id');
                    currentUpazilla = "{{$mwApplicantAddress ? $mwApplicantAddress->upazilla_id ?? $mwApplicantAddress->upzilla_id:null}}"
                    selected = "";
                    $.ajax({
                        url: `get-upazillas/${value_district_id}`,
                        type: 'GET',
                        dataType: 'JSON',
                        success: function (data) {
                            let selectOption = [];
                            data.forEach(function (upazilla) {
                                if (upazilla.id == currentUpazilla) {
                                    selected = "selected"
                                }
                                selectOption.push(`<option ${selected} value="${upazilla.id}">${upazilla.name}</option>`);
                                selected = "";
                            })
                            // console.log(selectOption);
                            upazillaDiv.html('');
                            upazillaDiv.html(selectOption);
                            // console.log(upazilla);
                        }

                    });

                }

                let currentDistrict = "{{$mwApplicantAddress?$mwApplicantAddress->district_id:null}}";
                setTimeout(() => {
                    if (currentDistrict) getUpazillas(currentDistrict);
                }, 500)
            </script>

        </div>

@endsection
