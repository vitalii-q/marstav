<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>Oops.. something went wrong..</title>

    <meta name="description" content="">

    <meta property="og:title" content="">
    <meta property="og:site_name" content="">
    <meta property="og:description" content="">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

    <link rel="shortcut icon" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('media/favicons/apple-touch-icon-180x180.png') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ URL::asset('css/codebase.min.css') }}">

</head>
<body>

<div id="page-container" class="main-content-boxed">

    <main id="main-container">

        <div class="hero bg-white">
            <div class="hero-inner">
                <div class="content content-full">
                    <div class="py-30 text-center">
                        <div class="display-3 text-info">
                            <i class="si si-info"></i>
                        </div>
                        <h1 class="h2 font-w700 mt-30 mb-10">Oops.. something went wrong..</h1>
                        <h2 class="h3 font-w400 text-muted mb-50">We are sorry but your request cannot be fulfilled..</h2>
                        <a class="btn btn-hero btn-rounded btn-alt-secondary" href="{{ url()->previous() }}">
                            <i class="fa fa-arrow-left mr-10"></i> Go back
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </main>

</div>

<script src="{{ URL::asset('js/codebase.core.min.js') }}"></script>

<script src="{{ URL::asset('js/codebase.app.min.js') }}"></script>
</body>
</html>
