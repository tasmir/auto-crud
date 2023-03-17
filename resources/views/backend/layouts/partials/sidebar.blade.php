<?php
use Illuminate\Support\Str;
$currentRoute = request()
    ->route()
    ->getName();
$current_params = request()
    ->route()
    ->parameters();
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link @if ($currentRoute == trans('lang.backend.name_prefix') . 'dashboard') active @endif"
                   href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{route(trans('lang.backend.name_prefix')."types.index")}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Types
                </a>
                <div class="sb-sidenav-menu-heading">All Types</div>
                @php
                $fields = \App\Models\Field::where("status", 1)->get();
                @endphp
                @foreach($fields as $key => $field)
                <a class="nav-link" href="{{route(trans("lang.backend.name_prefix")."field.index",$field)}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    {{$field->name}}
                </a>
                @endforeach
                <div class="sb-sidenav-menu-heading">Interface</div>
                <?php
                $inMenu = false;

                $amenity = trans('lang.backend.name_prefix') . 'amenity';
                //                $venue = trans('lang.backend.name_prefix') . 'venue';

                $userMenu = ["$amenity.index", "$amenity.edit"];
                if (in_array($currentRoute, $userMenu)) {
                    $inMenu = true;
                }
                ?>

                <a class="nav-link @if ($inMenu) active @else collapsed @endif" href="#"
                   data-bs-toggle="collapse" data-bs-target="#collapseVenues"
                   aria-expanded="@if ($inMenu) true @else false @endif"
                   aria-controls="collapseVenues">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-location-dot"></i></div>
                    Venues
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse @if ($inMenu) show @endif" id="collapseVenues"
                     aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        {{--                        <a class="nav-link @if ($currentRoute == "$venue.index" || $currentRoute == "$venue.create" || $currentRoute == "$venue.edit") active @endif"--}}
                        {{--                            href="{{ route("$venue.index") }}">Venue List</a>--}}
                        <a class="nav-link @if ($currentRoute == "$amenity.index" || $currentRoute == "$amenity.create" || $currentRoute == "$amenity.edit") active @endif"
                           href="{{-- route("$amenity.index") --}}">Amenities</a>
                    </nav>
                </div>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa-brands fa-osi"></i></div>
                    Organizer
                </a>
                {{--
                                <?php
                                $inMenu = false;

                                $category = trans('lang.backend.name_prefix') . 'category';
                                $event = trans('lang.backend.name_prefix') . 'event';
                                $audience = trans('lang.backend.name_prefix') . 'audience';

                                $userMenu = ["$category.index", "$category.edit", "$audience.index", "$audience.edit"];
                                if (in_array($currentRoute, $userMenu)) {
                                    $inMenu = true;
                                }
                                ?>
                                <a class="nav-link @if ($inMenu) active @else collapsed @endif" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapseEvents"
                                    aria-expanded="@if ($inMenu) true @else false @endif"
                                    aria-controls="collapseEvents">
                                    <div class="sb-nav-link-icon"><i class="fa-regular fa-calendar"></i></div>
                                    Events
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse @if ($inMenu) show @endif" id="collapseEvents"
                                    aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link " href="#">Event List</a>
                                        <a class="nav-link @if ($currentRoute == "$category.index") active @endif"
                                            href="{{ route("$category.index") }}">Category</a>
                                        <a class="nav-link @if ($currentRoute == "$audience.index") active @endif"
                                            href="{{ route("$audience.index") }}">Audiences</a>
                                        <a class="nav-link" href="#">Tickets</a>
                                    </nav>
                                </div>
                                --}}
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Event Users
                </a>
                <a class="nav-link" href="#">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-money-bill-trend-up"></i></div>
                    Payment Methods
                </a>

                {{--}}
                                <?php
                                $inMenu = false;

                                $user = trans('lang.backend.name_prefix') . trans('lang.system.name_prefix') . 'user';
                                $role = trans('lang.backend.name_prefix') . trans('lang.system.name_prefix') . 'role';
                                $permission = trans('lang.backend.name_prefix') . trans('lang.system.name_prefix') . 'permission';

                                $userMenu = ["$user.index", "$user.edit", "$role.index", "$role.edit", "$permission.index", "$permission.edit", "$permission.rearang"];
                                if (in_array($currentRoute, $userMenu)) {
                                    $inMenu = true;
                                }
                                ?>
                                <div class="sb-sidenav-menu-heading">System</div>
                                <a class="nav-link @if ($inMenu) active @else collapsed @endif" href="#"
                                    data-bs-toggle="collapse" data-bs-target="#collapse{{ trans('lang.system.url_prefix') }}"
                                    aria-expanded="@if ($inMenu) true @else false @endif"
                                    aria-controls="collapse{{ trans('lang.system.url_prefix') }}">
                                    <div class="sb-nav-link-icon"><i class="fa-brands fa-centos"></i></div>
                                    {{ ucwords(trans('lang.system.url_prefix')) }}
                                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                                </a>
                                <div class="collapse @if ($inMenu) show @endif"
                                    id="collapse{{ trans('lang.system.url_prefix') }}" aria-labelledby="headingOne"
                                    data-bs-parent="#sidenavAccordion">
                                    <nav class="sb-sidenav-menu-nested nav">
                                        <a class="nav-link @if ($currentRoute == "$user.index" || $currentRoute == "$user.edit") active @endif"
                                            href="{{ route("$user.index") }}">Users</a>
                                        <a class="nav-link @if ($currentRoute == "$role.index" || $currentRoute == "$role.edit") active @endif"
                                            href="{{ route("$role.index") }}">Role</a>
                                        <a class="nav-link @if (
                                            $currentRoute == "$permission.index" ||
                                                $currentRoute == "$permission.edit" ||
                                                $currentRoute == "$permission.rearang") active @endif"
                                            href="{{ route("$permission.index") }}">Permission</a>
                                    </nav>
                                </div>
                                --}}
                {{--
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="layout-static.html">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Addons</div>
                <a class="nav-link" href="charts.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                </a>
                --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name ?? '' }}
        </div>
    </nav>
</div>
