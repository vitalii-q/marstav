<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>

    <meta name="description" content="MARSTAV - online CRM система. Управление клиентами и бизнесом. Организуйте работу в вашей компании: чаты, сделки, задачи, заметки, напоминания.">

    <meta name="keywords" content="задачи, таск, менеджер, бесплатный, российский, онлайн, 2022, топ, система, управления, дедлайн, заметки, сделки, календарь, напоминания, дат, чат, сообщения, мессенджер, корпоративный, CRM, ru, клиент, deal, бизнес, процесс">

    <meta name="robots" content="index, follow">

    <meta property="og:title" content="Marstav - корпоративный онлайн помощник. Управление клиентами и бизнесом. CRM.">
    <meta property="og:site_name" content="marstav.ru">
    <meta property="og:description" content="MARSTAV - online CRM система. Управление клиентами и бизнесом. Организуйте работу в вашей компании: чаты, сделки, задачи, заметки, напоминания.">
    <meta property="og:type" content="website">
    <meta property="og:url" content="https://marstav.ru">
    <meta property="og:locale" content="ru">
    <meta property="og:image" content="{{ URL::asset('media/favicons/m-circle.png') }}">

    @yield('head')

    <link rel="shortcut icon" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ URL::asset('media/favicons/m-circle.png') }}">
    <link rel="apple-touch-icon" sizes="180x180" href="{{ URL::asset('media/favicons/m-circle.png') }}">

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,400i,600,700&display=swap">
    <link rel="stylesheet" id="css-main" href="{{ URL::asset('css/codebase.min.css') }}">

    <link rel="stylesheet" type="text/css" href="{{ URL::asset('css/styles.css') }}">
</head>
<body>

<div id="page-container" class="main-content-boxed">


    <main id="main-container">
        <div id="app">
            @yield('content')
        </div>
    </main>

</div>

<script src="{{ URL::asset('js/codebase.core.min.js') }}"></script>

<script src="{{ URL::asset('js/codebase.app.min.js') }}"></script>

<script src="{{ URL::asset('js/plugins/jquery-validation/jquery.validate.min.js') }}"></script>

<script src="{{ URL::asset('js/special/op_auth_signin.min.js') }}"></script>
</body>
</html>
