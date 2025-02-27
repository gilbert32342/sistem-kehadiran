<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Absensi LAB Coe')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <!-- Tambahkan Font Awesome CDN untuk ikon -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">  
    <style>
        [x-cloak] { display: none !important; }
        
        body {
            font-family: 'Poppins', sans-serif;
        }
        .nav-link {
            transition: color 0.3s ease;
        }
        .nav-link:hover {
            color: #d1d5db;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Navbar -->
    <nav class="bg-gradient-to-r from-blue-600 to-blue-500 p-4 text-white shadow-lg">
        <div class="container mx-auto flex justify-between items-center">
            <div class="text-2xl font-bold">@yield('page_title', '')</div>
            <ul class="flex space-x-4 items-center">
                @auth
                    <li class="font-semibold">{{ auth()->user()->name }}</li>
                @else
                    <li><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                @endauth
            </ul>
        </div>
    </nav>

    <!-- Content -->
    <div class="container mx-auto p-4 md:p-6 lg:p-8">
        @yield('content')
    </div>
</body>
</html>
