@extends("backend.layouts.master")
@push('title', $page_data->root_title.' '.$page_data->submodel)
@section('breadcrumb')
    <li class="breadcrumb-item"><a href="{{route($page_data->root_path.'.index')}}">{{$page_data->root_title}}</a></li>
    <li class="breadcrumb-item active" aria-current="page"><span>{{$page_data->submodel}}</span></li>
@endsection
@section('content')
    <div class="card card-outline">
        <div class="card-header p-0">
            <nav class="navbar navbar-light bg-light justify-content-between mx-2">
                <h4 class="text-muted mb-0">
                    <i class="{{$page_data->root_icon}}"></i>&nbsp;&nbsp;{{trim($page_data->root_title)}} <small
                        class="text-muted">{{ $page_data->submodel }}</small>
                </h4>

                <form class="form-inline">
                    <a class="btn btn-main btn-sm" href="{{route($page_data->root_path.'.index')}}"
                       title="Back To {{trim($page_data->root_title)}}">
                        <i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Back
                    </a>
                </form>

            </nav>
        </div>
        <div class="card-body">
            <form method="POST" action="{{route($page_data->root_path.'.store')}}" >
                @csrf
                <div id="type-form-generator"></div>
                {{--                <div class="banner-imager">--}}
                {{--                    @php--}}
                {{--                        $path = asset('assets/images/notfound.png');--}}
                {{--                    @endphp--}}
                {{--                    <img src="{{$path}}" id="view_the_image" style="max-width: 100%;">--}}
                {{--                </div>--}}
                {{--                <div class="form-group mb-3">--}}
                {{--                    <label for="exampleFormControlFile1">Banner Image</label>--}}
                {{--                    <input type="file" class="form-control-file" id="banner_image" name="banner_image">--}}
                {{--                </div>--}}

{{--                <fieldset>--}}
{{--                    <legend>Core</legend>--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="name">Name</label>--}}
{{--                        <input id="name" class="form-control" name="name" type="text" placeholder=""--}}
{{--                               required="required">--}}
{{--                        @error('name')--}}
{{--                        <div class="alert alert-danger mt-1">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="name">Slug</label>--}}
{{--                        <input id="slug" class="form-control" name="slug" type="text" placeholder=""--}}
{{--                               required="required">--}}
{{--                        @error('slug')--}}
{{--                        <div class="alert alert-danger mt-1">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="name">Icon</label>--}}
{{--                        <input id="icon" class="form-control" name="icon" type="text" placeholder="Icon"--}}
{{--                               required="required">--}}
{{--                        @error('icon')--}}
{{--                        <div class="alert alert-danger mt-1">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}


{{--                    <div class="form-group mb-3">--}}
{{--                        <label for="status">Status</label>--}}
{{--                        <select id="status" class="form-control" name="status">--}}
{{--                            <option value="1">Active</option>--}}
{{--                            <option value="0">Inactive</option>--}}
{{--                        </select>--}}
{{--                        @error('status')--}}
{{--                        <div class="alert alert-danger mt-1">{{ $message }}</div>--}}
{{--                        @enderror--}}
{{--                    </div>--}}
{{--                </fieldset>--}}


{{--                <fieldset id="type-form-generator"></fieldset>--}}
{{--                <fieldset>--}}
{{--                    <legend style="padding-left: 0;">--}}
{{--                        <button class="btn btn-main  btn-sm"><i class="fa fa-plus"></i></button>--}}
{{--                        Fields Setup--}}
{{--                    </legend>--}}
{{--                    <div class="row">--}}
{{--                        <div class="col-6">--}}
{{--                            <fieldset>--}}
{{--                                <legend class="close--button"><i class="fa-solid fa-xmark"></i></legend>--}}

{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="status">Name</label>--}}
{{--                                    <input class="form-control" name="name">--}}
{{--                                </div>--}}

{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="status">Type</label>--}}
{{--                                    <select class="form-control" name="type">--}}
{{--                                        <option value="text">Text</option>--}}
{{--                                        <option value="date">Date</option>--}}
{{--                                        <option value="email">Email</option>--}}
{{--                                    </select>--}}
{{--                                </div>--}}

{{--                                <div class="form-group mb-3">--}}
{{--                                    <label for="status">Option</label>--}}
{{--                                    <div class="input-group">--}}
{{--                                        <input class="form-control" value="Key" readonly>--}}
{{--                                        <input class="form-control" value="Value" readonly>--}}
{{--                                        <span class="input-group-text"><i--}}
{{--                                                class="fa-solid fa-circle-exclamation"></i></span>--}}
{{--                                    </div>--}}
{{--                                    <div>--}}
{{--                                        <div class="input-group">--}}
{{--                                            <input class="form-control" value="Options">--}}
{{--                                            <input class="form-control" value="Options">--}}
{{--                                            <span class="input-group-text" id="basic-addon2"><i--}}
{{--                                                    class="fa-solid fa-xmark"></i>&nbsp;</span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="form-group mb-3">--}}
{{--                                    <input class="form-control" value="Order" readonly>--}}
{{--                                </div>--}}
{{--                                <div class="form-group">--}}
{{--                                    <input class="form-control" value="Action" readonly>--}}
{{--                                </div>--}}

{{--                            </fieldset>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </fieldset>--}}

{{--                <div class="text-left">--}}
{{--                    <input class="btn btn-main" type="submit" value="Submit">--}}
{{--                </div>--}}

            </form>
        </div>
    </div>
@endsection



@push("css")
    <style>
        .banner-imager img {
            width: 100%;
            height: 10rem;
            object-fit: cover;
        }

        .remove-radious .form-control {
            border-radius: 0;
        }
    </style>
@endpush

@push("plugin-scripts")
    <script type="text/javascript" src="{{asset("assets/plugins/jquery/jquery-3.6.3.min.js")}}"></script>
    {{--    <script src="https://cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>--}}

@endpush
@push('custom-scripts')


    <script>

        // $(document).ready(function () {
        //     // $('.ckeditor').ckeditor();
        //     CKEDITOR.replace( 'description' );
        // });
        // $("#save").click(function(event){
        //     let content = CKEDITOR.instances['ckeditor'].getData();
        //     content = content.replaceAll("</", "&#60;&#47;"); // ending tag start;
        //     content = content.replaceAll("<", '&#60;'); // tag start;
        //     content = content.replaceAll(">", "&#62;"); // tag close;
        //     $("#vaal").val(content);
        //     // console.log(content);
        //     event.target.form.submit();
        // });

        // $("#google_map").change(function () {
        //     $("#map").val('');
        //     let text = $(this).val();
        //     text = text.replace(`width="600"`, `width="100%"`);
        //     console.log(text)
        //     $("#map").val(text);
        //     $('#google_map_section').prepend(text);
        // });
        // $("#banner_image").change(function () {
        //     $('#view_the_image').attr('src', $(this).attr('data-src'));
        // });
    </script>
    {{--    @include("laravelmedia::media")--}}
@endpush
