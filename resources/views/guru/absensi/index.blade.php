@extends('layouts.app')

@section('title', 'Absensi Guru')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Absensi Guru</h1>

    <!-- 🔹 Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-2 rounded mb-4">
            {{ session('error') }}
        </div>
    @endif

    <!-- 🔹 Tombol Absensi -->
    <form action="{{ route('guru.absensi.store') }}" method="POST" class="mb-4">
        @csrf
        <label class="block mb-2 text-gray-700 font-semibold">Pilih Status:</label>
        <select name="status" class="border p-2 w-full rounded focus:ring-2 focus:ring-blue-500">
            <option value="hadir">✅ Hadir</option>
            <option value="izin">🟡 Izin</option>
            <option value="sakit">🟠 Sakit</option>
            <option value="alpha">❌ Alpha</option>
        </select>
        <button type="submit" class="mt-3 bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded w-full sm:w-auto">
            Simpan Absensi
        </button>
    </form>

    <!-- 🔹 Tabel Absensi Guru -->
    <div class="overflow-x-auto">
        <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
            <thead class="bg-gray-200">
                <tr>
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Nama</th>
                    <th class="p-3 text-left">NIP</th>
                    <th class="p-3 text-left">Status</th>
                </tr>
            </thead>
            <tbody>
                @forelse($absensi as $item)
                <tr class="border-b">
                    <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
                    <td class="p-3">{{ $item->nama ?? 'Tidak diketahui' }}</td>
                    <td class="p-3">{{ $item->nip ?? '-' }}</td>
                    <td class="p-3">
                        @if($item->status == 'hadir')
                            <span class="text-green-500">✅ Hadir</span>
                        @elseif($item->status == 'izin')
                            <span class="text-yellow-500">🟡 Izin</span>
                        @elseif($item->status == 'sakit')
                            <span class="text-orange-500">🟠 Sakit</span>
                        @else
                            <span class="text-red-500">❌ Alpha</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="text-center p-4 text-gray-500">Belum ada data absensi</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
