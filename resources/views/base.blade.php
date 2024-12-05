<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" sizes="32x32" href="../../public/images/logo-32x32.png">
    <link rel="icon" sizes="16x16" href="../../public/images/logo-16x16.png">
    <link rel="apple-touch-icon" type="image/png" sizes="180x180" href="../../public/images/logo-180x180.png">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/variables.css') }}">
    <link rel="stylesheet" href="{{ asset('css/reset.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/_button.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/_nav.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components/_link.css') }}">
    @yield('styles')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">

</head>
<body>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">
            {{session('success')}}
        </div>
    @endif
    @yield('content')
</div>
</body>
</html>

