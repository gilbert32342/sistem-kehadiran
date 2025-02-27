@extends('layouts.app')

@section('content')
<div class="container mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4">📚 Daftar Materi</h2>

    <!-- Filter Pengurutan -->
    <div class="mb-4 flex justify-between items-center">
        <form method="GET" action="{{ route('siswa.materi.index') }}" class="flex items-center space-x-2">
            <label for="sort" class="text-gray-700">Urutkan:</label>
            <select name="sort" id="sort" class="border rounded px-3 py-1" onchange="this.form.submit()">
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
            </select>
        </form>
        
        <a href="{{ route('siswa.dashboard') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">🔙 Kembali</a>
    </div>

    @foreach($materis as $materi)
    <div class="bg-white p-4 mb-4 rounded-md shadow">
        <h3 class="text-xl font-semibold">{{ $materi->judul }}</h3>
        <p class="text-gray-600">{{ Str::limit($materi->deskripsi, 100) }}</p>
        <p class="text-sm text-gray-500">Diuplode oleh: <strong>{{ $materi->creator->name ?? 'Admin' }}</strong></p>
        <a href="{{ route('siswa.materi.show', $materi->id) }}" class="text-blue-500">📄 Lihat Materi</a>
    </div>
    @endforeach    

    <!-- Pagination -->
    <div class="mt-5">
        {{ $materis->appends(['sort' => request('sort')])->links() }}
    </div>
</div>
@endsection
