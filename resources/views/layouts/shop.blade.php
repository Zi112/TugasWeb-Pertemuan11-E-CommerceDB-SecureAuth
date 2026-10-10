<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Toko') — E-Commerce</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="min-h-screen bg-gray-100 font-sans text-gray-900 antialiased">
    <nav class="bg-white shadow-sm">
        <div class="mx-auto flex max-w-6xl items-center justify-between px-6 py-4">
            <a href="{{ url('/') }}" class="font-bold text-indigo-600">🛒 Toko Online</a>
            <div class="flex gap-4 text-sm">
                @auth
                    <a href="{{ route('dashboard') }}" class="hover:text-indigo-600">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="hover:text-indigo-600">Login</a>
                    <a href="{{ route('register') }}" class="hover:text-indigo-600">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <main class="mx-auto max-w-6xl px-6 py-10">@yield('content')</main>
</body>
</html>
