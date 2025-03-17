@extends('layouts.guru')

@section('title', 'Absensi Guru')

@section('content')
<div class="max-w-5xl mx-auto mt-6 animate-fade-in" x-data="{ showNotification: true }">
    <h1 class="text-2xl font-bold text-gray-700 mb-4 animate-fade-in-up">📋 Absensi Guru</h1>

    
    @if(session('success') || session('error'))
        <div x-show="showNotification" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 transform translate-y-0" x-transition:leave-end="opacity-0 transform translate-y-4" class="relative mb-4 p-4 rounded-lg shadow-md {{ session('success') ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700' }}">
            {!! session('success') ?? session('error') !!}
            <button @click="showNotification = false" class="absolute top-2 right-2 p-1 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    
    <form action="{{ route('guru.absensi.store') }}" method="POST" class="mb-6 animate-fade-in-up">
        @csrf
        <label class="block mb-2 text-gray-700 font-semibold">Pilih Status:</label>
        <select name="status" class="w-full p-3 border rounded-lg focus:ring-2 focus:ring-blue-500 transition duration-300 ease-in-out">
            <option value="hadir">✅ Hadir</option>
            <option value="izin">🟡 Izin</option>
            <option value="sakit">🟠 Sakit</option>
            <option value="alpha">❌ Alpha</option>
        </select>
        <button type="submit" class="mt-4 w-full sm:w-auto px-6 py-3 bg-blue-500 text-white font-semibold rounded-lg hover:bg-blue-600 transition duration-300 ease-in-out transform hover:scale-105">
            Simpan Absensi
        </button>
    </form>

    
    <div class="overflow-x-auto animate-fade-in-up">
        <table class="w-full bg-white shadow-lg rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left text-gray-700">Tanggal</th>
                    <th class="p-3 text-left text-gray-700">Nama</th>
                    <th class="p-3 text-left text-gray-700">NIP</th>
                    <th class="p-3 text-left text-gray-700">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $item)
                <tr class="border-b hover:bg-gray-50 transition duration-200">
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="p-3">{{ $item->nama ?? 'Tidak diketahui' }}</td>
                    <td class="p-3">{{ $item->nip ?? '-' }}</td>
                    <td class="p-3">
                        @if($item->status == 'hadir')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700">✅ Hadir</span>
                        @elseif($item->status == 'izin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">🟡 Izin</span>
                        @elseif($item->status == 'sakit')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700">🟠 Sakit</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700">❌ Alpha</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-6 text-gray-500">Belum ada data absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
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