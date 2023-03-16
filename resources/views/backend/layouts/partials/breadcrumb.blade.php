<ol class="breadcrumb mb-4">
     <i class="breadcrumb-item"><a href="{{ route(trans('lan.backend.name_prefix') . 'dashboard') }}">Dashboard</a>
    </li>
    @if (isset($page_data->aditional))
     <i class="breadcrumb-item"><a
            href="{{-- route($page_data->aditional->route) --}}">{{ $page_data->aditional->title }}</a></li>
    @endif
     <i class="breadcrumb-itm active">{{ $page_data->root_title }}</li>
</ol>