@extends('layouts.app')

@section('content')
<div x-data="{ open: true }" class="flex h-screen bg-gray-100">
    <!-- Sidebar -->
    @include('components.sidebar-siswa')

    <!-- Konten Utama -->
    <div class="flex-1 transition-all duration-300 overflow-y-auto" :class="open ? 'lg:ml-64' : 'lg:ml-20'">
        <!-- Navbar -->
        <div class="p-5 bg-white shadow-md">
            <h1 class="text-xl font-semibold">Dashboard</h1>
        </div>

        <!-- Konten -->
        <div class="p-5">
            <p>Konten utama di sini...</p>
        </div>
    </div>
</div>
@endsection
