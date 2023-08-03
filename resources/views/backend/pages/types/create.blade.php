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
            <form method="POST" action="#" >
                @csrf
                <input type="hidden" value="{{$page_data->action}}" id="action_url">
                <input type="hidden" value="{{ $page_data->submodel }}" id="to_do">
                <input type="hidden" value="{{ $page_data->slug_check }}" id="slug_check">
                <input type="hidden" value="{{ $page_data->list }}" id="type_list">
                <div id="type-form-generator"></div>
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
        .field-header {
            position: relative;
        }
        .field-header legend {
            position: absolute;
            top: 26px;
            right: -21px;
            z-index: 2;
            padding: 0 0.3rem;
        }
        .accordion .accordion-body .main-field {
            display: flex;
            flex-direction: row-reverse;
        }
        .accordion .accordion-body .field-part {
            width: 100%;
        }
        .accordion .accordion-body .field-closer {
            display: flex;
            align-items: center;
        }
        .accordion .accordion-body .field-closer div {
            position: absolute;
            right: 40px;
        }
    </style>
@endpush

@push("plugin-scripts")
    <script type="text/javascript" src="{{asset("assets/plugins/jquery/jquery-3.6.3.min.js")}}"></script>
    {{--    <script src="https://cdn.ckeditor.com/4.4.5/standard/ckeditor.js"></script>--}}

@endpush
@push('custom-scripts')
    <script></script>
@endpush
