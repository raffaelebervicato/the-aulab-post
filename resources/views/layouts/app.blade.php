<!doctype html>
<html lang="it">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'The Aulab Post')</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    @include('partials.navbar')
    <main class="container py-4">
        @yield('content')
    </main>
</body>
</html>
