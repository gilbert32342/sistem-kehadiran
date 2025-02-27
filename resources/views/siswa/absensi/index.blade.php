@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="max-w-4xl mx-auto mt-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">Absensi Siswa</h1>

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
    <form action="{{ route('siswa.absensi.store') }}" method="POST" class="mb-4">
        @csrf
        <label class="block mb-2 text-gray-700">Pilih Status:</label>
        <select name="status" class="border p-2 w-full rounded">
            <option value="hadir">✅ Hadir</option>
            <option value="izin">🟡 Izin</option>
            <option value="sakit">🟠 Sakit</option>
            <option value="alpha">❌ Alpha</option>
        </select>
        <button type="submit" class="mt-2 bg-blue-500 text-white px-4 py-2 rounded">
            Simpan Absensi
        </button>
    </form>

    <!-- 🔹 Tabel Absensi Guru -->
    <table class="w-full bg-white shadow-md rounded-lg overflow-hidden">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-3">Tanggal</th>
                <th class="p-3">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $item)
            <tr class="border-b">
                <td class="p-3">{{ \Carbon\Carbon::parse($item->tanggal)->format('d M Y') }}</td>
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
            @endforeach
        </tbody>
    </table>
</div>
@endsection
