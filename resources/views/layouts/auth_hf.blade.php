<!doctype html>
<html lang="en" class="no-focus">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">

    <title>@yield('title')</title>

    <meta name="description" content="Сделками и напоминания по календарю, задачи сотрудникам компании,
     дедлайн и наблюдение за выполнением задач, общение и обмен файлами в чате,
     заметки онлайн с любого устройства с доступом к интернету">

    <meta name="keywords" content="менеджер задач, таск манеджер, таск менеджер бесплатный, лучшие таск менеджеры, российский таск менеджер,
    таск менеджер онлайн, таск менеджер 2022, командный таск менеджер, топ таск менеджеров, простой таск менеджер,
    корпоративные задачи, постановщик задач, задачи с дедлайном,
    заметки, заметки онлайн, записки онлайн,
    сделки, сделки по календарю, напоминания, напоминания по календарю,
    корпоративный чат, корпоративный месенджер, корпоративный мессенджер, корпоративное общение,
    CRM, CRM система, CRM для бизнеса, crm ru, бесплатная crm, простая crm, crm клиенты, crm сайт, crm управление, crm deal, личная crm,
    crm site, crm система бесплатно">

    <meta name=”robots” content="index, follow">

    <meta property="og:title" content="CRM MARSTAV - корпоративный помощник">
    <meta property="og:site_name" content="MARSTAV">
    <meta property="og:description" content="Сделками и напоминания по календарю, задачи сотрудникам компании,
     дедлайн и наблюдение за выполнением задач, общение и обмен файлами в чате,
     заметки онлайн с любого устройства с доступом к интернету">
    <meta property="og:type" content="website">
    <meta property="og:url" content="">
    <meta property="og:image" content="">

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
