<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sistem Absensi LAB Coe')</title>
    @vite('resources/css/app.css')
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@2.8.2/dist/alpine.min.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        [x-cloak] { display: none !important; }
        body {
            font-family: 'Poppins', sans-serif;
        }
        .icon {
            width: 24px;
            height: 24px;
            display: flex;
            align-items: center;
            justify-content: center;
        }
    </style>
</head>
<body class="bg-gray-100 flex" x-data="{
    open: localStorage.getItem('sidebarOpen') === 'true',
    toggle() {
        this.open = !this.open;
        localStorage.setItem('sidebarOpen', this.open);
    }
}">

    <!-- Sidebar -->
    <div :class="{'w-72': open, 'w-24': !open}" class="bg-gray-800 text-white h-screen p-5 transition-all duration-300 fixed top-0 left-0 z-10">
        <div class="flex items-center justify-between">
            <h2 x-show="open" class="text-2xl font-bold ml-3">Siswa Panel</h2>
            <button @click="toggle" class="text-white p-2 hover:bg-gray-700 rounded-lg ml-2">
                <svg :class="{'rotate-180': !open}" class="w-7 h-7 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                </svg>
            </button>
        </div>

        <ul class="mt-10 space-y-5">
            <li>
                <a href="{{ route('siswa.dashboard') }}" 
                    class="flex items-center py-2 px-4 rounded-lg transition-all 
                    {{ request()->routeIs('siswa.dashboard') ? 'bg-gray-900 font-bold' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-home icon"></i>
                    <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.materi.index') }}" 
                    class="flex items-center py-2 px-4 rounded-lg transition-all 
                    {{ request()->routeIs('siswa.materi.index') ? 'bg-gray-900 font-bold' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-book icon"></i>
                    <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Materi</span>
                </a>
            </li>
            <li>
                <a href="{{ route('siswa.kehadiran.index') }}" 
                    class="flex items-center py-2 px-4 rounded-lg transition-all 
                    {{ request()->routeIs('siswa.kehadiran.index') ? 'bg-gray-900 font-bold' : 'hover:bg-gray-700' }}">
                    <i class="fas fa-history icon"></i>
                    <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Riwayat Kehadiran</span>
                </a>
            </li>
            <li class="mt-10 border-t border-gray-700 pt-5">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full flex items-center py-2 px-4 rounded-lg transition-all hover:bg-red-600 text-red-300 hover:text-white">
                        <i class="fas fa-sign-out-alt icon"></i>
                        <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Logout</span>
                    </button>
                </form>
            </li>            
        </ul>
        
        <div class="absolute bottom-5 left-0 w-full text-center">
            <p class="text-gray-300 text-sm font-semibold">© 2025 Admin LAB Coe</p>
        </div>
    </div>

    <!-- Main Content -->
    <div :class="{'ml-72': open, 'ml-24': !open}" class="flex-1 min-h-screen transition-all duration-300">
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
        <div class="p-4 md:p-6 lg:p-8">
            @yield('content')
        </div>
    </div>
</body>
</html>