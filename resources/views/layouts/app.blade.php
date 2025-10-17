<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Laravel App')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div class="container">
        <h1>My Laravel App</h1>
        @include('partials.flash')
        @yield('content')
    </div>
</body>
</html>
