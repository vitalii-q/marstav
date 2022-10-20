@extends('layouts.auth_hf')

@section('title', 'Marstav - корпоративный онлайн помощник. Управление клиентами и бизнесом.')

@section('content')
    <div class="bg-image" style="background-image: url('{{ URL::asset('media/photos/photo34@2x.jpg') }}')">
        <div class="row mx-0 bg-black-op">
            <div class="hero-static col-md-6 col-xl-8 d-md-flex flex-wrap">

                <div class="login_title_block_wrapper content content-full">
                    <div class="login_title_block px-30 py-10">
                        <a class="link-effect font-w700" href="/">
                            <span class="fs-40 text-white">MAR</span><span class="fs-40">STAV</span>
                        </a>
                    </div>
                </div>

                <div class="welcome_content p-30 col-12 invisible" data-toggle="appear">

                    <div class="welcome_block">
                        <i class="si si-puzzle welcome_icon"></i>
                        <div class="welcome_right">
                            <h3 class="welcome_title">Менеджер задач</h3>
                            <div class="welcome_text font-italic">Назначайте задачи сотрудникам и наблюдайте за ходом их выполнения.</div>
                        </div>
                    </div>

                    <div class="welcome_block">
                        <i class="si si-like welcome_icon"></i>
                        <div class="welcome_right">
                            <h3 class="welcome_title">Сделки и напоминания</h3>
                            <div class="welcome_text font-italic">Поэтапное управление сделками. Удобное взаимодействие с календарем.</div>
                        </div>
                    </div>

                    <div class="welcome_block">
                        <i class="si si-note welcome_icon"></i>
                        <div class="welcome_right">
                            <h3 class="welcome_title">Заметки онлайн</h3>
                            <div class="welcome_text font-italic">Заметки онлайн. Всегда под рукой где бы вы не были.</div>
                        </div>
                    </div>

                    <div class="welcome_block">
                        <i class="si si-speech welcome_icon"></i>
                        <div class="welcome_right">
                            <h3 class="welcome_title">Корпоративный чат</h3>
                            <div class="welcome_text font-italic">Корпоративный чат для общения и обмена файлами.</div>
                        </div>
                    </div>

                </div>

            </div>

            <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                <div class="content content-full">

                    <div class="px-30 py-10">
                        <a class="link-effect font-w700" href="/">
                            <span class="font-size-xl text-primary-dark">MAR</span><span class="font-size-xl">STAV</span>
                        </a>
                        <h1 class="h3 font-w700 mt-30 mb-10">Управление бизнесом</h1>
                        <h2 class="h5 font-w400 text-muted mb-0">Пожалуйста авторизуйтесь</h2>
                    </div>

                    <form class="js-validation-signin px-30" action="{{ route('login') }}" method="post">
                        @csrf

                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label for="email">{{ __('Email Address') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="form-material floating">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror

                                    <label for="password">{{ __('Password') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-12">
                                <div class="custom-control custom-checkbox">
                                    <input class="custom-control-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                    <label class="custom-control-label" for="remember">{{ __('Remember Me') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                <i class="si si-login mr-10"></i> {{ __('Login') }}
                            </button>
                            <div class="mt-30">
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('register') }}">
                                    <i class="si si-plus mr-5"></i> Создать аккаунт
                                </a>
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('password.request') }}">
                                    <i class="si si-info mr-5"></i> {{ __('Forgot Your Password?') }}
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection
