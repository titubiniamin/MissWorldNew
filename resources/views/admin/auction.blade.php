<!DOCTYPE HTML>
@extends('layouts.admin_app')
@push('title')
    Auction Entry
@endpush
<script src="https://cdn.tiny.cloud/1/5rqxzpgdgtbbjb56h4gqj9nltw5v6hvlkxu1z3q52m742ikm/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
<script type="text/javascript">
    tinymce.init({
        selector: 'textarea',
        branding: false
    });
</script>
@section('main-content')

    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        {{--                        {{dd($errors)}}--}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {{--                            @error('title')--}}
                        {{--                            <div class="error">{{ $message }}</div>--}}
                        {{--                            @enderror--}}
                        <h4 class="card-title">Entry</h4>
                        <div class="form-validation">
                            <form class="form-valide" action="{{route('auction.store')}}" method="post"
                                  enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-username">Title <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{old('title')}}" class="form-control" name="title"
                                               id="val-username"
                                               placeholder="Enter a title..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-code">Code <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{old('code')}}" class="form-control" id="val-email"
                                               name="code"
                                               placeholder="Your valid code..">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="val-password">Details <span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <textarea name="details">{{old('details')}}</textarea></div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="quantity">Quantity<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{old('quantity')}}" class="form-control"
                                               id="quantity" name="quantity"
                                               placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="price">Price<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="text" value="{{old('price')}}" class="form-control" id="price"
                                               name="price"
                                               placeholder="Price">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="price">Start Date<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="date" value="{{old('start')}}" class="form-control" id="start"
                                               name="start"
                                               placeholder="Start">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="price">End Date<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <input type="date" class="form-control" id="end" name="end"
                                               placeholder="End">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="price">Video Upload<span
                                            class="text-danger">*</span>
                                    </label>
                                    <div class="col-lg-6">
                                        <video
                                            controls
                                            width="200"
                                            height="140"
                                            poster=""
                                            id="video_preview_main"
                                        >

                                            <source id="video_preview"
                                                    src=""
                                                    type="video/mp4">
                                        </video>

                                        <input id="video" type="file"
                                               class="form-control @error('video') is-invalid @enderror"
                                               name="video"
                                               value=""
                                               autocomplete="video" autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label class="col-lg-4 col-form-label" for="Image">Image Upload
                                        <button type="button" onclick="addPhoto()" id="addBtn"
                                                class="addBtn btn mb-1 btn-outline-primary">
                                            +
                                        </button>
                                    </label>

                                    <div class="col-lg-8">
                                        <div class="row" id="add-append">
                                            <div  id="image-div">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <img height="100" width="100">
                                                        <span class="remove-btn text-danger ml-3">
                                                            <i class="fa fa-times-circle fa-2x"></i></span>
                                                    </div>
                                                    <input
                                                        class="image-file"
                                                        type="file"
                                                           name="photos[]"
                                                           value=""
                                                           autocomplete="nid" autofocus>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <div class="col-lg-8 ml-auto">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // photo.onchange = () => {
        //     console.log(photo)
        //     const [file] = photo.files
        //     if (file) {
        //         photo_preview.src = URL.createObjectURL(file)
        //     }
        // }
        video.onchange = () => {
            const [file] = video.files
            if (file) {
                video_preview_main.src = URL.createObjectURL(file)
                console.log(video_preview_main.src)
                console.log(document.querySelector("video").src)
            }
        }


        function addPhoto() {
            $('#add-append').append(`<div  id="image-div">
                                                <div class="col-md-6 mb-3">
                                                    <div class="d-flex">
                                                        <img height="100" width="100">
                                                        <span class="remove-btn text-danger ml-3">
                                                            <i class="fa fa-times-circle fa-2x"></i></span>
                                                    </div>
                                                    <input
                                                           class="image-file"
                                                           type="file"
                                                           name="photos[]"
                                                           value=""
                                                           autocomplete="nid" autofocus>
                                                </div>
                                            </div>`);
        }


        $('#add-append').on('change', '.image-file', function (e) {
            if(e.target.files[0]){
                $(this).parent().find('img')[0].src = URL.createObjectURL(e.target.files[0])
            }

        })

        $('#add-append').on('click', '.remove-btn', function (e) {
            $(this).parent().parent().remove();
            if(($.trim($('#image-div').html()).length) == 0) addPhoto()
        })



    </script>
@endsection
