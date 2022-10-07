@extends('layouts.auth_hf')

@section('title', 'Сброс пароля')

@section('content')
    <div class="bg-image" style="background-image: url('{{ URL::asset('media/photos/photo34@2x.jpg') }}')">
        <div class="row mx-0 bg-black-op">
            <div class="hero-static col-md-6 col-xl-8 d-none d-md-flex align-items-md-end">
                <div class="p-30 invisible" data-toggle="appear">
                    <p class="font-size-h3 font-w600 text-white">
                        Вдохновляйтесь и творите.
                    </p>
                    <p class="font-italic text-white-op">
                        Copyright &copy; <span class="js-year-copy"></span>
                    </p>
                </div>
            </div>

            <div class="hero-static col-md-6 col-xl-4 d-flex align-items-center bg-white invisible" data-toggle="appear" data-class="animated fadeInRight">
                <div class="content content-full">

                    <div class="px-30 py-10">
                        <a class="link-effect font-w700" href="/">
                            <span class="font-size-xl text-primary-dark">MAR</span><span class="font-size-xl">STAV</span>
                        </a>
                        <h1 class="h3 font-w700 mt-30 mb-10">Ваш бизнес помощник</h1>
                        <h2 class="h5 font-w400 text-muted mb-0">Сбросить пароль</h2>
                    </div>

                    <form class="js-validation-signin px-30" action="{{ route('password.email') }}" method="POST">
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

                        <div class="form-group">
                            <button type="submit" class="btn btn-sm btn-hero btn-alt-primary">
                                <i class="si si-login mr-10"></i> {{ __('Send Password Reset Link') }}
                            </button>
                            <div class="mt-30">
                                <a class="link-effect text-muted mr-10 mb-5 d-inline-block" href="{{ route('login') }}">
                                    <i class="si si-login mr-5"></i> Авторизоваться
                                </a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

