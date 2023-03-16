@extends('backend.layouts.master')
@push('title', $page_data->root_title . ' ' . $page_data->submodel)
@section('page-title', "$page_data->root_title $page_data->submodel")


@section('content')
    <div class="row">
        <div class="col-12 col-md-12 col-lg-12">
            <div class="card card-theme-main card-outline">
                <div class="card-header p-0">
                    <nav class="navbar navbar-light bg-light justify-content-between mx-2">

                        <h4 class="text-muted mb-0">
                            <i class="{{ $page_data->root_icon }}"></i>&nbsp;&nbsp;{{ trim($page_data->root_title) }} <small
                                class="text-muted">{{ $page_data->submodel }}</small>
                        </h4>

                        <form class="form-inline">
                            @can("$page_data->root_path.create")
                                <a class="btn btn-main  btn-sm" href="{{ route("$page_data->root_path.create") }}"
                                    title="Add {{ trim($page_data->root_title) }}">
                                    <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                                </a>
                            @endcan
                        </form>

                    </nav>
                </div>
                <div class="card-body  ">

                    <div class="">

                        <div class="row">
                            <div class="col-5 unselected">

                                {{--                                <ul> --}}
                                <div class="search--text">
                                    <input type="text" id="search" class="form-control"
                                        placeholder="Search Amenities...">
                                </div>
                                @forelse($model_data as $key => $data)
                                    @if ($data->status == '0')
                                        <div class="collection-item panel-heading" data-search="{{ $data->name }}"
                                            data-index="{{ $data->building_id }}" data-position="{{ $data->id }}"
                                            data-id="{{ $data->id }}">
                                            <div>
                                                <i class="fas fa-ellipsis-v text-secondary item--dot"></i>
                                                {{ $data->name }}
                                            </div>
                                            <div>
                                                @if ($data->image)
                                                    <button type="button" class="btn btn-sm border" data-bs-toggle="modal"
                                                        data-bs-target="#image-id-{{ $data->id }}">
                                                        <i class="fas fa-image text-success"></i>
                                                    </button>

                                                    <div class="modal fade" id="image-id-{{ $data->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                {{--                                                                <div class="modal-body"> --}}
                                                                <img src="{{ asset('storage/' . $data->media->original_path) }}"
                                                                    style="max-width: 100%;">
                                                                {{--                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <a href="{{ route("$page_data->root_path.edit", $data) }}" type="button"
                                                    class="btn btn-sm border edit--button">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm border remove--button">
                                                    <i class="fas fa-minus-circle text-danger"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm add--button">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button>
                                            </div>

                                        </div>
                                    @endif
                                @empty
                                @endforelse
                                {{--                                </ul> --}}
                            </div>

                            <div class="col-7 selected-amenities">

                                @forelse($model_data as $key => $data)
                                    @if ($data->status == '1')
                                        <div class="collection-item panel-heading" data-search="{{ $data->name }}"
                                            data-index="{{ $data->building_id }}" data-position="{{ $data->id }}"
                                            data-id="{{ $data->id }}">
                                            <div>
                                                <i class="fas fa-ellipsis-v text-secondary item--dot"></i>
                                                {{ $data->name }}
                                            </div>
                                            <div>
                                                @if ($data->image)
                                                    <button type="button" class="btn btn-sm border" data-bs-toggle="modal"
                                                        data-bs-target="#image-id-{{ $data->id }}">
                                                        <i class="fas fa-image text-success"></i>
                                                    </button>

                                                    <div class="modal fade" id="image-id-{{ $data->id }}"
                                                        tabindex="-1" role="dialog"
                                                        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered modal-lg"
                                                            role="document">
                                                            <div class="modal-content">
                                                                {{--                                                                <div class="modal-body"> --}}
                                                                <img src="{{ asset('storage/' . $data->media->original_path) }}"
                                                                    style="max-width: 100%;">
                                                                {{--                                                                </div> --}}
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endif
                                                <a href="{{ route("$page_data->root_path.edit", $data) }}" type="button"
                                                    class="btn btn-sm border edit--button">
                                                    <i class="fas fa-pencil-alt text-info"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm border remove--button">
                                                    <i class="fas fa-minus-circle text-danger"></i>
                                                </button>
                                                <button type="button" class="btn btn-sm add--button">
                                                    <i class="fas fa-plus-circle"></i>
                                                </button>
                                            </div>

                                        </div>
                                    @endif
                                @empty
                                @endforelse
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>
    </div>

@stop

@section('page-styles')
    <style>
        .table--image img {
            max-width: 40px;
        }

        /*.edit--button, */
        .add--button,
        .remove--button,
        .item--dot {
            display: none;
        }

        .unselected .add--button,
        .selected-amenities .edit--button,
        .selected-amenities .remove--button,
        .selected-amenities .item--dot {
            display: inline-block;
        }

        .unselected .search--text input {
            background-color: transparent;
            border: none;
            border-bottom: 1px solid #9e9e9e;
            border-radius: 0;
            outline: none;
            height: 3rem;
            width: 100%;
            font-size: 1rem;
            margin: 0 0 15px 0;
            padding: 0;
            box-shadow: none;
            -webkit-box-sizing: content-box;
            -moz-box-sizing: content-box;
            box-sizing: content-box;
            transition: all .3s;
        }

        .unselected .search--text {
            ackground-color: #fff;
            line-height: 1.5rem;
            padding: 10px 20px 10px 0px;
            margin: 0;
            /*border-bottom: 1px solid #e0e0e0;*/
            list-style: none;
        }

        .unselected .collection-item {
            background-color: #fff;
            line-height: 1.5rem;
            padding: 10px 20px 10px 10px;
            margin: 0;
            border-bottom: 1px solid #e0e0e0;
            list-style: none;
            display: flex;
            justify-content: space-between;
            background-color: #ababa0;
        }

        .unselected .collection-item button {
            width: 30px;
            height: 30px;
            /*line-height: 30px;*/
            vertical-align: middle;
            top: -3px;
            right: -10px;
            background: #fff;
        }

        .panel-heading.collection-item,
        .panel-heading.collection-item>div>i {
            color: #fff !important;
        }

        .collection-item button,
        .collection-item a {
            background-color: #fff;
        }

        .selected-amenities .panel-heading {
            color: #333;
            /*background-color: #fff;*/
            /*border-color: #ddd;*/
            position: relative;
            /*height: 30px;*/
            padding: 10px 15px;

            background-color: #fff;
            border: 1px solid #ddd;
            border-radius: 4px;
            -webkit-box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
            box-shadow: 0 1px 1px rgb(0 0 0 / 5%);
            margin: 5px 0;
            display: flex;
            justify-content: space-between;
            background-color: #8cd98c;
        }
    </style>
@endsection

@push('plugin-scripts')
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery/jquery-3.6.3.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('assets/plugins/jquery-ui/jquery-ui.min.js') }}"></script>
    {{--    <script type="text/javascript" src="{{asset("js/multiselect.js")}}"></script> --}}
@endpush
@push('custom-scripts')
    <script>
        $(document).ready(function() {
            $('.selected-amenities').sortable({
                update: function(event, ui) {
                    $(this).children().each(function(index) {

                        // if($(this).attr('data-position') !=(index+1)){
                        $(this).attr('data-position', (index + 1)).addClass('updated')
                        // }
                    });
                    saveNewPositions();
                }
            });

            $('#search').on('input', function() {
                var searchTerm = $.trim(this.value).toLowerCase();
                $('.collection-item').each(function() {
                    if (searchTerm.length < 1) {
                        $(this).show();
                    } else {
                        $(this).toggle($(this).filter('[data-search*="' + searchTerm + '"]')
                            .length > 0);
                    }
                });
            })

            $('.add--button').on('click', function(event) {

                // console.log($(this).parent().parent().attr("data-id"))
                statusChange($(this).parent().parent().attr("data-id"), "1");
                $(".selected-amenities").append($(this).parent().parent());
            });
            $('.remove--button').on('click', function(event) {
                // console.log($(this).parent().parent())
                statusChange($(this).parent().parent().attr("data-id"), "0");
                $(".unselected").append($(this).parent().parent());
            });

        });

        function saveNewPositions() {
            let positions = [];
            $('.updated').each(function() {
                positions.push([
                    $(this).attr('data-id'),
                    $(this).attr('data-position'),
                    $(this).attr('data-index')

                ]);
                $(this).removeClass('updated');
            });
            // console.log(positions);

            $.ajax({
                url: "{{ route($page_data->root_path . '.rearang.store') }}",
                type: 'post',
                data: {
                    positions: positions,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // console.table(response);
                }
            });
        }

        function statusChange(model, positions) {
            $.ajax({
                url: "{{ route($page_data->root_path . '.status.change') }}",
                type: 'post',
                data: {
                    model: model,
                    positions: positions,
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    // console.table(response);
                }
            });
        }
    </script>

@endpush
