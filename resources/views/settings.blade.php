@extends('layouts.hf')

@section('title', 'Настройки')

@section('css')

@endsection

@section('js')
    <script src="{{ URL::asset('js/pages/settings.js') }}"></script>

    <!-- Page JS Plugins -->
    <script src="{{ URL::asset('js/plugins/sweetalert2/sweetalert2.all.js') }}"></script>
@endsection

@section('content')

    <div class="content">
        <div class="content-heading pt-8">
            Настройки
            <div class="dropdown float-right">
                <a onclick="saveStages()" type="button" class="btn btn-square btn-primary text-white max-width-125 ml-auto d-block">Сохранить</a>
            </div>
        </div>

        @if(session()->has('info'))
            <p class="alert alert-info">{{ session()->get('info') }}</p>
        @endif

        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-eye mr-5 text-muted"></i> Визуальные настройки
                </h3>
            </div>

            <div class="block-content">
                <div class="row items-push">

                    <div class="col-12 col-md-6">
                        <h6 class="dropdown-header">Header</h6>
                        <div class="row gutters-tiny text-center mb-5">
                            <div class="col-6">
                                <button onclick="changeHeaderMode()" type="button" class="btn btn-sm btn-block btn-alt-secondary" data-toggle="layout" data-action="header_fixed_toggle">Fixed Mode</button>
                            </div>
                            <div class="col-6">
                                <button onclick="changeHeaderStyle()" type="button" class="btn btn-sm btn-block btn-alt-secondary d-none d-lg-block mb-10">Modern Style</button>
                            </div>
                        </div>
                        <h6 class="dropdown-header">Sidebar</h6>
                        <div class="row gutters-tiny text-center mb-5">
                            <div class="col-6">
                                <button onclick="changeSidebarStyle('light')" type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_off">Light</button>
                            </div>
                            <div class="col-6">
                                <button onclick="changeSidebarStyle('dark')" type="button" class="btn btn-sm btn-block btn-alt-secondary mb-10" data-toggle="layout" data-action="sidebar_style_inverse_on">Dark</button>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <h6 class="dropdown-header">Color Themes</h6>
                        <div class="row no-gutters text-center mb-5">
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('default')" class="text-default" data-toggle="theme" data-theme="default" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('/css/themes/elegance.min.css')" class="text-elegance" data-toggle="theme" data-theme="/css/themes/elegance.min.css" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('/css/themes/pulse.min.css')" class="text-pulse" data-toggle="theme" data-theme="/css/themes/pulse.min.css" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('/css/themes/flat.min.css')" class="text-flat" data-toggle="theme" data-theme="/css/themes/flat.min.css" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('/css/themes/corporate.min.css')" class="text-corporate" data-toggle="theme" data-theme="/css/themes/corporate.min.css" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                            <div class="col-2 mb-5">
                                <a onclick="changeTheme('/css/themes/earth.min.css')" class="text-earth" data-toggle="theme" data-theme="css/themes/earth.min.css" href="javascript:void(0)">
                                    <i class="si si-drop fa-2x"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-badge mr-5 text-muted"></i> Тарифный план
                </h3>
            </div>

            <div class="block-content">

                @if($user->paid)
                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            Ваш тарифный план: <br><br>
                            Оплачено до:
                        </p>
                    </div>

                    <div class="col-lg-7 offset-lg-1">

                        <div class="form-group row">
                            <div class="col-12">
                                {{ $user->rate_name }} <br><br>
                                {{ \App\Helpers\Date::getDay(date('d', strtotime($user->paid))).' '.\App\Helpers\Date::getMonth(date('m', strtotime($user->paid))).' '.date('Y', strtotime($user->paid)) }}
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="row items-push">
                    <div class="col-lg-3">
                        <p class="text-muted">
                            Тарифный план определяет определяет возможности которые вы можете использовать. <br>
                            Обратите внимание, тарифный план закрепляется за компанией, если вы не состоите в компании, она будет создана автоматически.
                        </p>
                    </div>

                    <div class="col-lg-7 offset-lg-1">

                        <div class="form-group row">
                            <div class="col-12">
                                <a href="{{ route('rates') }}" class="btn btn-alt-primary">Посмотреть тарифы</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        @if($user->company_id)
            <div class="block">
                <div class="block-header block-header-default">
                    <h3 class="block-title">
                        <i class="si si-users mr-5 text-muted"></i> Компания: {{ App\Models\Company::query()->where('id', $user->company_id)->first()->name }}
                    </h3>
                </div>

                <div class="block-content">
                    <div class="row items-push">
                        <div class="col-lg-3">
                            <p class="text-muted">
                                Если вы выйдете из компании, вы утратите доступ к задачам и чату компании.
                            </p>
                        </div>

                        <div class="col-lg-7 offset-lg-1">

                            <div class="form-group row">
                                <div class="col-12">
                                    <button id="expel_an_employee" data-code="{{ $user->code }}" class="btn btn-alt-danger js-swal-confirm">Выйти из компании</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="block">

            <div class="block-header block-header-default">
                <h3 class="block-title">
                    <i class="si si-docs mr-5 text-muted"></i> Файловое хранилище
                </h3>
            </div>

            <div class="block-content">
                <div class="row items-push">

                    <div class="col-sm-6 py-10">
                        <h3 class="h5 font-w700 mb-15">
                            Место в файловом хранилище<span class="text-muted"></span>
                        </h3>
                        <div class="progress mb-5" style="height: 8px;">
                            <div class="progress-bar progress-bar-striped progress-bar-animated bg-{{ $storage_style }}" role="progressbar" style="width: {{ $space_percents }}%;" aria-valuenow="30" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                        <p class="font-size-sm font-w600 mb-0">
                            <span class="font-w700">{{ \App\Modules\Storage\Calculator::bToGb($space_involved) }}GB</span> из <span class="font-w700">{{ \App\Modules\Storage\Calculator::bToGb($user->space) }}GB</span> занято
                        </p>
                    </div>
                    <div class="col-sm-6 py-10 text-md-right">
                    </div>

                </div>
            </div>

        </div>

    </div>

@endsection
