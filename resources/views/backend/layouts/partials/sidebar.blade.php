<?php
use Illuminate\Support\Str;
$currentRoute = request()
    ->route()
    ->getName();
$current_params = request()
    ->route()
    ->parameters();
$prefix = trans('lang.backend.name_prefix');
?>
<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link @if ($currentRoute == $prefix . 'dashboard') active @endif"
                   href="#">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <a class="nav-link @if ($currentRoute == $prefix . 'types.index') active @endif" href="{{route($prefix."types.index")}}">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-tags"></i></div>
                    Types
                </a>
                <div id="side-menu-of-types"></div>


            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->name ?? '' }}
        </div>
    </nav>
</div>
