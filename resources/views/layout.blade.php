<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <script src="{{ URL::asset('assets/bower/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ URL::asset('assets/bower/bootstrap/dist/js/bootstrap.min.js') }}"></script>
    <link rel="stylesheet" href="{{ URL::asset('assets/bower/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ URL::asset('css/main.css') }}">
</head>
<body>
    <main class="container">
        @include('components.navbar',['navbarTitle'=>'穀保家商餐飲管理科倉儲系統'])
        @yield('content')
        @include('components.footer')
    </main>
</body>
</html>