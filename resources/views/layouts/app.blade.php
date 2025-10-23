<!DOCTYPE html>
<html>
<head>
    <title>@yield('title', 'My Laravel App')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="container">
        <h1>My Laravel App</h1>
        @include('partials.flash')
        @yield('content')
    </div>
</body>
</html>
