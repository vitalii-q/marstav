<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Codebase - Bootstrap 4 Admin Template &amp; UI Framework</title>

    <meta name="description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta name="author" content="pixelcave">
    <meta name="robots" content="noindex, nofollow">

    <meta property="og:title" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework">
    <meta property="og:site_name" content="Codebase">
    <meta property="og:description" content="Codebase - Bootstrap 4 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('media/favicons/m-circle.png') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ URL::asset('css/codebase.min.css') }}">

</head>
<body>

<div id="page-container" class="main-content-boxed">


    <main id="main-container">
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
                            <h1 class="h3 font-w700 mt-30 mb-10">Ваш корпоративный менеджер</h1>
                            <h2 class="h5 font-w400 text-muted mb-0">Пожалуйста авторизуйтесь</h2>
                        </div>

                        <form class="js-validation-signin px-30" action="{{ route('register') }}" method="post">
                            @csrf

                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating pt-20">
                                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                        @error('name')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                        @enderror

                                        <label for="name">{{ __('Name') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-12">
                                    <div class="form-material floating pt-20">
                                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

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
                                    <div class="form-material floating pt-20">
                                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

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
                                    <div class="form-material floating pt-20">
                                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">

                                        <label for="password-confirm">{{ __('Confirm Password') }}</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-sm btn-hero btn-alt-primary mt-5">
                                    <i class="si si-login mr-10"></i> {{ __('Register') }}
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

    </main>

</div>

<script src="{{ URL::asset('js/codebase.core.min.js') }}"></script>

<script src="{{ URL::asset('js/codebase.app.min.js') }}"></script>

<script src="{{ URL::asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ URL::asset('js/special/op_auth_signin.min.js') }}"></script>
</body>
</html>
