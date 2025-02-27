@extends('layouts.app')

@section('title', 'Absensi Siswa')

@section('content')
<div class="max-w-5xl mx-auto mt-6">
    <h1 class="text-2xl font-bold text-gray-700 mb-4">📋 Absensi Siswa</h1>

    <!-- 🔹 Notifikasi -->
    @if(session('success'))
        <div class="bg-green-100 text-green-700 p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
            {!! session('error') !!} {{-- Pakai {!! !!} agar bisa render <br> untuk multi error --}}
        </div>
    @endif

    <!-- 🔹 Form Absensi -->
    <form action="{{ route('guru.absensi.siswa.store') }}" method="POST">
        @csrf

        <div class="overflow-x-auto bg-white shadow-md rounded-lg p-4">
            <table class="table-auto w-full border-collapse border">
                <thead>
                    <tr class="bg-gray-200">
                        <th class="border p-2">NIS</th>
                        <th class="border p-2">Nama</th>
                        <th class="border p-2">Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($siswa as $item)
                    <tr>
                        <td class="border p-2">{{ $item->nis }}</td>
                        <td class="border p-2">{{ $item->name }}</td>
                        <td class="border p-2">
                            <select name="absensi[{{ $item->nis }}]" class="border p-2 rounded">
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
        <div class="mt-5 text-right">
            <button type="submit" class="bg-blue-500 text-white px-5 py-2 rounded shadow hover:bg-blue-600">
                💾 Simpan Absensi
            </button>
        </div>
    </form>
</div>
@endsection
