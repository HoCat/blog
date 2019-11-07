<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'learn blog')</title>
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
  
</head>
<body>
    @include('layout.header')

    <div class="container">
        @include('shared.message')
        @yield('content')
        @include('layout.footer')
    </div>
    <script href="/js/app.js"></script>
</body>
</html>