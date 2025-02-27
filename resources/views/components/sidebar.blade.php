<div x-data="{ open: true }" :class="{'w-64': open, 'w-20': !open}" x-transition.duration.300ms class="bg-gray-800 text-white h-full p-5 transition-all duration-300 lg:fixed lg:top-0 lg:left-0 lg:h-screen z-10">
    <!-- Logo or Panel Title -->
    <div class="flex items-center justify-between">
        <div class="flex items-center space-x-4">
            <svg x-show="open" class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v8m0 0l4-4m4 4l-4-4"/>
            </svg>
            <h2 x-show="open" class="text-xl font-bold">Admin Panel</h2>
        </div>
        <!-- Toggle Sidebar -->
        <button @click="open = !open" class="text-white p-2 hover:bg-gray-700 rounded-lg">
            <svg :class="{'rotate-180': !open}" class="w-6 h-6 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
            </svg>
        </button>
    </div>

    <!-- Menu Sidebar -->
    <ul class="mt-10 space-y-5">
        <li>
            <a href="{{ route('admin.users.index') }}" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-all rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zM4 16c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V4c0-1.1-.9-2-2-2H6c-1.1 0-2 .9-2 2v12z"/>
                </svg>
                <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Manajemen Pengguna</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.statistik-kehadiran') }}" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-all rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M21 12c0 4.97-4.03 9-9 9s-9-4.03-9-9 4.03-9 9 9zM12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2z"/>
                </svg>
                <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Statistik Kehadiran</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.rekap.index') }}" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-all rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M12 18c-3.31 0-6-2.69-6-6s2.69-6 6-6 6 2.69 6 6-2.69 6-6 6zM1 12c0-5.52 4.48-10 10-10s10 4.48 10 10-4.48 10-10-4.48-10-10 4.48-10 10-10z"/>
                </svg>
                <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Rekap & Laporan</span>
            </a>
        </li>
        <li>
            <a href="{{ route('admin.materi.index') }}" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-all rounded-lg">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                    <path d="M3 12l2 2l5-5l5 5l2-2M12 2v12" />
                </svg>
                <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Manajemen Materi</span>
            </a>
        </li>
        <!-- Logout -->
        <li>
            <form action="{{ route('logout') }}" method="POST" class="flex items-center py-2 px-4 hover:bg-gray-700 transition-all rounded-lg">
                @csrf
                <button type="submit" class="w-full flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                        <path d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a4 4 0 01-8 0v-1m8 0v-1a4 4 0 00-8 0v1" />
                    </svg>
                    <span :class="{'block': open, 'hidden': !open}" class="ml-2 text-sm">Logout</span>
                </button>
            </form>
        </li>
    </ul>
</div>
