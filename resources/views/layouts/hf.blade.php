<?php
$user = \Illuminate\Support\Facades\Auth::user();
$settings = \App\Models\Setting::query()->where('user_id', $user->id)->first();
?>
<!doctype html>
<html lang="en" class="no-focus">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

        <title>@yield('title')</title>

        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- Icons -->
        <!-- The following icons can be replaced with your own, they are used by desktop and mobile browsers -->
        <link rel="shortcut icon" href="{{ URL::asset('media/favicons/m-circle.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('media/favicons/favicon-192x192.png') }}">
        <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('media/favicons/apple-touch-icon-180x180.png') }}">
        <!-- END Icons -->

        <!-- Stylesheets -->
        <!-- Fonts and Codebase framework -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
        <link rel="stylesheet" id="css-main" href="{{ URL::asset('css/codebase.min.css') }}">

        <!-- You can include a specific file from css/themes/ folder to alter the default color theme of the template. eg: -->
        @if($settings->theme != 'default')
        <link rel="stylesheet" id="css-theme" href="{{ $settings->theme }}">
        @endif
        <!-- END Stylesheets -->

        <!-- Styles custom -->
        <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/styles.css') }}">

        @yield('css')
    </head>
    <body>

        <div id="page-container" class="sidebar-o
        @if($settings->header_style == 'modern') page-header-modern @endif
        @if($settings->header_mode == 'fixed') page-header-fixed @endif
        @if($settings->sidebar_style == 'dark') sidebar-inverse @endif
         enable-page-overlay side-scroll main-content-boxed ">

            <!-- Sidebar -->
            <!--
                Helper classes

                Adding .sidebar-mini-hide to an element will make it invisible (opacity: 0) when the sidebar is in mini mode
                Adding .sidebar-mini-show to an element will make it visible (opacity: 1) when the sidebar is in mini mode
                    If you would like to disable the transition, just add the .sidebar-mini-notrans along with one of the previous 2 classes

                Adding .sidebar-mini-hidden to an element will hide it when the sidebar is in mini mode
                Adding .sidebar-mini-visible to an element will show it only when the sidebar is in mini mode
                    - use .sidebar-mini-visible-b if you would like to be a block when visible (display: block)
            -->
            <nav id="sidebar">
                <!-- Sidebar Content -->
                <div class="sidebar-content">
                    <!-- Side Header -->
                    <div class="content-header content-header-fullrow px-15">
                        <!-- Mini Mode -->
                        <div class="content-header-section sidebar-mini-visible-b">
                            <!-- Logo -->
                            <span class="content-header-item font-w700 font-size-xl float-left animated fadeIn">
                                                <span class="text-dual-primary-dark">c</span><span class="text-primary">b</span>
                                            </span>
                            <!-- END Logo -->
                        </div>
                        <!-- END Mini Mode -->

                        <!-- Normal Mode -->
                        <div class="content-header-section text-center align-parent sidebar-mini-hidden">
                            <!-- Close Sidebar, Visible only on mobile screens -->
                            <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                            <button type="button" class="btn btn-circle btn-dual-secondary d-lg-none align-v-r" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times text-danger"></i>
                            </button>
                            <!-- END Close Sidebar -->

                            <!-- Logo -->
                            <div class="content-header-item">
                                <a class="link-effect font-w700" href="" target="_blank">
                                    <i class="si si-note text-primary"></i>
                                    <span class="font-size-xl text-dual-primary-dark">mar</span>
                                    <span class="font-size-xl text-primary">stav</span>
                                </a>
                            </div>
                            <!-- END Logo -->
                        </div>
                        <!-- END Normal Mode -->
                    </div>
                    <!-- END Side Header -->

                    <!-- Side User -->
                    <div class="content-side content-side-full content-side-user px-10 align-parent">
                        <!-- Visible only in mini mode -->
                        <div class="sidebar-mini-visible-b align-v animated fadeIn">
                            @if($user->photo)
                                <div class="img-avatar user_avatar" style="background-image: url({{ $user->photo }})"></div>
                            @else
                                <img class="img-avatar" src="{{ URL::asset('media/avatars/avatar2.jpg') }}" alt="">
                            @endif
                        </div>
                        <!-- END Visible only in mini mode -->

                        <!-- Visible only in normal mode -->
                        <div class="sidebar-mini-hidden-b text-center">
                            <a class="img-link" href="">
                                @if($user->photo)
                                    <div class="img-avatar user_avatar" style="background-image: url({{ $user->photo }})"></div>
                                @else
                                    <img class="img-avatar" src="{{ URL::asset('media/avatars/avatar2.jpg') }}" alt="">
                                @endif
                            </a>
                            <ul class="list-inline mt-10">
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark font-size-sm font-w600 text-uppercase" href="">{{ $user->name }}</a>
                                </li>
                                <li class="list-inline-item">
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <!--<a class="link-effect text-dual-primary-dark" data-toggle="layout" data-action="sidebar_style_inverse_toggle" href="javascript:void(0)">
                                        <i class="si si-drop"></i>
                                    </a>-->
                                </li>
                                <li class="list-inline-item">
                                    <a class="link-effect text-dual-primary-dark" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                         document.getElementById('logout-form').submit();">
                                        <i class="si si-logout"></i>
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </div>
                        <!-- END Visible only in normal mode -->
                    </div>
                    <!-- END Side User -->

                    <!-- Side Navigation -->
                    <div class="content-side content-side-full">
                        <ul class="nav-main">
                            <li>
                                <a href="/"><i class="si si-cup"></i><span class="sidebar-mini-hide">Рабочий стол</span></a>
                            </li>
                            <?php
                            $new_mess = \App\Models\Message::query()->where('to_id', $user->id)->where('view', null)->get();
                            ?>
                            <li>
                                <a href="{{ route('chat') }}" class="d-flex"><i class="si si-bubbles"></i>
                                    <span class="sidebar-mini-hide">Чат</span>
                                    @if(count($new_mess))
                                    <div class="ml-auto mt--2">
                                        <span class="badge badge-danger badge-pill">{{ count($new_mess) }}</span>
                                    </div>
                                    @endif
                                </a>
                            </li>
                            <!--<li>
                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="si si-badge"></i><span class="sidebar-mini-hide">Page Kits</span></a>
                                <ul>
                                    <li class="open">
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span class="sidebar-mini-hide">Dashboards</span></a>
                                        <ul>
                                            <li>
                                                <a class="active" href="be_pages_dashboard2.html"><span class="sidebar-mini-hide">Dashboard 2</span></a>
                                            </li>
                                            <li>
                                                <a href="be_pages_dashboard3.html"><span class="sidebar-mini-hide">Dashboard 3</span></a>
                                            </li>
                                            <li>
                                                <a href="be_pages_dashboard4.html"><span class="sidebar-mini-hide">Dashboard 4</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><span class="sidebar-mini-hide">Alternative Dashboards</span></a>
                                        <ul>
                                            <li>
                                                <a href="db_classic.html"><span class="sidebar-mini-hide">Classic</span></a>
                                            </li>
                                            <li>
                                                <a href="db_clean.html"><span class="sidebar-mini-hide">Clean</span></a>
                                            </li>
                                            <li>
                                                <a href="db_social.html"><span class="sidebar-mini-hide">Social</span></a>
                                            </li>
                                            <li>
                                                <a href="db_corporate.html"><span class="sidebar-mini-hide">Corporate</span></a>
                                            </li>
                                            <li>
                                                <a href="db_minimal.html"><span class="sidebar-mini-hide">Minimal</span></a>
                                            </li>
                                            <li>
                                                <a href="db_pop.html"><span class="sidebar-mini-hide">Pop</span></a>
                                            </li>
                                            <li>
                                                <a href="db_dark.html"><span class="sidebar-mini-hide">Dark</span></a>
                                            </li>
                                            <li>
                                                <a href="db_medical.html"><span class="sidebar-mini-hide">Medical</span></a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>-->
                            <li>
                                <a href="{{ route('note_folders.notes.index') }}"><i class="si si-book-open"></i><span class="sidebar-mini-hide">Заметки</span></a>
                            </li>
                            <li>
                                <a href="{{ route('tasks.index') }}"><i class="si si-paper-clip"></i><span class="sidebar-mini-hide">Задачи</span></a>
                            </li>
                            <li>
                                <a href="{{ route('deals.index') }}"><i class="si si-layers"></i><span class="sidebar-mini-hide">Сделки</span></a>
                            </li>
                            <li>
                                <a href="{{ route('contacts.index') }}"><i class="si si-users"></i><span class="sidebar-mini-hide">Контакты</span></a>
                            </li>
                            <li class="mb-20"></li>
                            <li>
                                <a href="{{ route('company.index') }}"><i class="si si-users"></i><span class="sidebar-mini-hide">Компания</span></a>
                            </li>
                            <li>
                                <a href="{{ route('profile.show', [$user->code]) }}"><i class="si si-moustache"></i><span class="sidebar-mini-hide">Профайл</span></a>
                            </li>
                            <li>
                                <a href="{{ route('settings') }}"><i class="si si-settings"></i><span class="sidebar-mini-hide">Настройки</span></a>
                            </li>
                        </ul>
                    </div>
                    <!-- END Side Navigation -->
                </div>
                <!-- Sidebar Content -->
            </nav>
            <!-- END Sidebar -->

            <!-- Header -->
            <header id="page-header">
                <!-- Header Content -->
                <div class="content-header">
                    <!-- Left Section -->
                    <div class="content-header-section">
                        <!-- Toggle Sidebar -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!--<button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="sidebar_toggle">
                            <i class="fa fa-navicon"></i>
                        </button>-->
                        <!-- END Toggle Sidebar -->

                        <!-- Open Search Section -->
                        <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                        <!--<button type="button" class="btn btn-circle btn-dual-secondary" data-toggle="layout" data-action="header_search_on">
                            <i class="fa fa-search"></i>
                        </button>-->
                        <!-- END Open Search Section -->
                    </div>
                    <!-- END Left Section -->

                    <!-- Right Section -->
                    <div class="content-header-section">
                        <!-- User Dropdown -->
                        <div class="btn-group" role="group">
                            <button type="button" class="btn btn-rounded btn-dual-secondary" id="page-header-user-dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fa fa-user d-sm-none"></i>
                                <span class="d-none d-sm-inline-block">{{ $user->name }}</span>
                                <i class="si si-arrow-down ml-5 fs-12"></i>
                            </button>
                            <div class="dropdown-menu dropdown-menu-right min-width-200" aria-labelledby="page-header-user-dropdown">
                                <h5 class="h6 text-center py-10 mb-5 border-b text-uppercase">{{ $user->name }}</h5>
                                <a class="dropdown-item" href="{{ route('profile.show', [$user->code]) }}">
                                    <i class="si si-user mr-5"></i> Профайл
                                </a>
                                <a class="dropdown-item d-flex align-items-center justify-content-between" href="{{ route('chat') }}">
                                    <span><i class="si si-envelope-open mr-5"></i> Сообщения</span>
                                    @if(count($new_mess))
                                    <span class="badge badge-primary">{{ count($new_mess) }}</span>
                                    @endif
                                </a>
                                <div class="dropdown-divider"></div>

                                <!-- Toggle Side Overlay -->
                                <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                <a class="dropdown-item" href="{{ route('settings') }}">
                                    <i class="si si-wrench mr-5"></i> Настройки
                                </a>
                                <!-- END Side Overlay -->

                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="si si-logout mr-5"></i> Выйти
                                </a>
                            </div>
                        </div>
                        <!-- END User Dropdown -->


                    </div>
                    <!-- END Right Section -->
                </div>
                <!-- END Header Content -->

                <!-- Header Search -->
                <div id="page-header-search" class="overlay-header">
                    <div class="content-header content-header-fullrow">
                        <form action="be_pages_generic_search.html" method="post">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <!-- Close Search Section -->
                                    <!-- Layout API, functionality initialized in Template._uiApiLayout() -->
                                    <button type="button" class="btn btn-secondary" data-toggle="layout" data-action="header_search_off">
                                        <i class="fa fa-times"></i>
                                    </button>
                                    <!-- END Close Search Section -->
                                </div>
                                <input type="text" class="form-control" placeholder="Search or hit ESC.." id="page-header-search-input" name="page-header-search-input">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-secondary">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- END Header Search -->

                <!-- Header Loader -->
                <!-- Please check out the Activity page under Elements category to see examples of showing/hiding it -->
                <div id="page-header-loader" class="overlay-header bg-primary">
                    <div class="content-header content-header-fullrow text-center">
                        <div class="content-header-item">
                            <i class="fa fa-sun-o fa-spin text-white"></i>
                        </div>
                    </div>
                </div>
                <!-- END Header Loader -->
            </header>
            <!-- END Header -->

            <main id="main-container">
                <div id="app">
                    @yield('content')
                </div>
            </main>

            @include('parts.notifications')

            <!-- Footer -->
            <footer id="page-footer" class="page-footer opacity-0">
                <div class="content py-20 font-size-sm clearfix">
                    <!--<div class="float-right">
                        Crafted with <i class="fa fa-heart text-pulse"></i> by <a class="font-w600" href="https://github.com/VitalyWeb" target="_blank">VitalyWeb</a>
                    </div>
                    <div class="float-left">
                        <a class="font-w600" href="https://github.com/VitalyWeb" target="_blank">Marstav</a> &copy; <span class="js-year-copy"></span>
                    </div>-->
                </div>
            </footer>
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        <!--
            Codebase JS Core

            Vital libraries and plugins used in all pages. You can choose to not include this file if you would like
            to handle those dependencies through webpack. Please check out assets/_es6/main/bootstrap.js for more info.

            If you like, you could also include them separately directly from the assets/js/core folder in the following
            order. That can come in handy if you would like to include a few of them (eg jQuery) from a CDN.

            assets/js/core/jquery.min.js
            assets/js/core/bootstrap.bundle.min.js
            assets/js/core/simplebar.min.js
            assets/js/core/jquery-scrollLock.min.js
            assets/js/core/jquery.appear.min.js
            assets/js/core/jquery.countTo.min.js
            assets/js/core/js.cookie.min.js
        -->
        <script src="{{ URL::asset('js/codebase.core.min.js') }}"></script>

        <!--
            Codebase JS

            Custom functionality including Blocks/Layout API as well as other vital and optional helpers
            webpack is putting everything together at assets/_es6/main/app.js
        -->
        <script src="{{ URL::asset('js/codebase.app.min.js') }}"></script>

        <!-- Page JS Plugins -->
        <script src="{{ URL::asset('js/plugins/chartjs/Chart.bundle.min.js') }}"></script>

        <!-- Page JS Code -->
        <script src="{{ URL::asset('js/special/be_pages_dashboard.min.js') }}"></script>

{{--        <script src="{{ URL::asset('js/app.js') }}" defer></script>--}}

        <!-- custom js -->
        <script src="{{ URL::asset('js/script.js') }}"></script>

        @yield('js')
    </body>
</html>
