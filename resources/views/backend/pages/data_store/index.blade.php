@extends("backend.layouts.master")
@push('title', $page_data->root_title.' '.$page_data->submodel)
@section('page-title', "$page_data->root_title $page_data->submodel")


@section('content')
    <div class="card  card-outline">
        <div class="card-header p-0">
            <nav class="navbar navbar-light bg-light justify-content-between mx-2">

                <h4 class="text-muted mb-0">
                    <i class="{{$page_data->root_icon}}"></i>&nbsp;&nbsp;{{trim($page_data->root_title)}} <small
                        class="text-muted">{{ $page_data->submodel }}</small>
                </h4>

                <form class="form-inline">
{{--                    @can("user_create")--}}
                        <a class="btn btn-main  btn-sm" href="{{route("$page_data->root_path.create", [$page_data->parent])}}"
                           title="Add {{trim($page_data->root_title)}}">
                            <i class="fa fa-plus"></i>&nbsp;&nbsp;Add
                        </a>
{{--                    @endcan--}}
                </form>

            </nav>
        </div>

        <!-- <h4 class="card-title">Data table</h4> -->


        <div class="card-body">

            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table id="order-listing" class="table">
                            <thead>
                            <tr>
{{--                                <th class="text-center">Banner</th>--}}
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Icon</th>
                                <th>Updated</th>
                                <th style="text-align: right;">Actions</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($model_data as $key => $data)

                                <tr>
                                    <td>{{$data->name}}</td>
                                    <td>{{$data->slug}}</td>
                                    <td>{{$data->status}}</td>
                                    <td><i class="{{$data->icon}}"></i></td>
                                    <td>{{$data->updated_at}}</td>
                                    <td style="text-align: right;">
                                        @can('user_view')
                                            <a href="#" class="btn btn-outline-success btn-sm btn-rounded mr-1"
                                               title="View"><i class="fa fa-eye"></i></a>
                                        @endcan
{{--                                        @can('user_edit')--}}
                                            <a href="{{ route("$page_data->root_path.edit", [$page_data->parent, $data->id]) }}"
                                               class="btn btn-outline-primary btn-sm btn-rounded mr-1"
                                               title="Edit"><i class="fas fa-edit"></i></a>
{{--                                        @endcan--}}
                                        @can('user_delete')
                                            <form method="POST"
                                                  class="btn p-0"
                                                  action="{{route("$page_data->root_path.destroy", [$page_data->parent, $data->id])}}">
                                                @method('DELETE')
                                                @csrf
                                                <button type="submit"
                                                        class="btn btn-outline-danger  btn-sm btn-rounded mr-1"
                                                        title="Delete"><i class="fas fa-trash"></i></button>
                                            </form>
                                        @endcan
                                    </td>
                                </tr>


                            @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



        </div>

    </div>
@endsection

@push("css")
    <style>
        .info-box .info-box-icon {
            width: 50px;
            border-radius: 50%;
            height: 50px;
        }

        .table--image img {
            width: 200px;
            height: 100px;
            object-fit: cover;
        }

        .table--image .user_image {
            width: 45px;
            height: 45px;
            object-fit: cover;
            border-radius: 50%;
        }

        .inline {
            display: inline-block;
        }

        .line--one {
            display: contents;
        }

        .line--two {
            display: contents;
            color: #6c757d;
        }

        .table tr td:nth-child(1),
        .table tr td:nth-child(2),
        .table tr td:nth-child(3),
        .table tr td:nth-child(4) {
            max-width: 22%;
        }

        .table tr td:nth-child(6) {
            text-align: right;
        }

        .amenity_name {
            display: block;
            max-width: 275px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
    </style>
@endpush
@section("page-scripts")
    <script>

    </script>
@endsection
