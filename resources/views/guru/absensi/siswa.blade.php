@extends('layouts.guru')

@section('title', 'Absensi Siswa')

@section('content')
<div class="max-w-5xl mx-auto mt-6 animate-fade-in" x-data="{ showNotification: true }">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 animate-fade-in-up">📋 Absensi Siswa</h1>

    <!-- 🔹 Notifikasi -->
    @if(session('success') || session('error'))
        <div x-show="showNotification" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="relative mb-4 p-4 rounded-lg shadow-md {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {!! session('success') ?? session('error') !!}
            <button @click="showNotification = false" class="absolute top-2 right-2 p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- 🔹 Filter Kelas -->
    <form action="{{ route('guru.absensi.siswa') }}" method="GET" class="mb-4">
        <div class="flex gap-3">
            <select name="kelas" class="border p-2 rounded-lg shadow-sm">
                <option value="">Pilih Kelas</option>
                @foreach($kelasList as $kelas)
                    <option value="{{ $kelas }}" {{ request('kelas') == $kelas ? 'selected' : '' }}>{{ $kelas }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg shadow-sm hover:bg-blue-600 transition duration-200">🔍 Filter</button>
        </div>
    </form>

    <!-- 🔹 Form Absensi -->
    <form action="{{ route('guru.absensi.siswa.store') }}" method="POST">
        @csrf

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4 animate-fade-in-up">
            <table class="table-auto w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-3 text-left text-gray-700">NIS</th>
                        <th class="border p-3 text-left text-gray-700">Nama</th>
                        <th class="border p-3 text-left text-gray-700">Kelas</th>
                        <th class="border p-3 text-left text-gray-700">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                    <tr class="hover:bg-gray-50 transition duration-200">
                        <td class="border p-3">{{ $item->nis }}</td>
                        <td class="border p-3">{{ $item->name }}</td>
                        <td class="border p-3">{{ $item->kelas }}</td>
                        <td class="border p-3">
                            <select name="absensi[{{ $item->nis }}]" class="w-full p-2 border rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
                                <option value="hadir">✅ Hadir</option>
                                <option value="izin">🟡 Izin</option>
                                <option value="sakit">🟠 Sakit</option>
                                <option value="alpha">❌ Alpha</option>
                            </select>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 🔹 Tombol Simpan -->
        <div class="mt-5 text-right animate-fade-in-up">
            <button type="submit" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
                💾 Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
@endpush

@push('styles')
<style>
    .animate-fade-in {
        animation: fadeIn 0.6s ease-in-out;
    }

    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-in-out;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
@endpush
