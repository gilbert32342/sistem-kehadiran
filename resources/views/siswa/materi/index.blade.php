@extends('layouts.siswa')

@section('content')
<div class="container mx-auto p-5">
    <h2 class="text-2xl font-bold mb-4 animate-fade-in">📚 Daftar Materi</h2>

    
    <div class="mb-4 flex justify-between items-center animate-fade-in">
        <form method="GET" action="{{ route('siswa.materi.index') }}" class="flex items-center space-x-2">
            <label for="sort" class="text-gray-700">Urutkan:</label>
            <select name="sort" id="sort" class="border rounded px-3 py-1 transition duration-300 ease-in-out hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500" onchange="this.form.submit()">
                <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A-Z</option>
                <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z-A</option>
            </select>
        </form>

    </div>

    @foreach($materis as $materi)
    <div class="bg-white p-4 mb-4 rounded-md shadow-lg transform transition duration-300 ease-in-out hover:scale-102 hover:shadow-xl animate-fade-in-up">
        <h3 class="text-xl font-semibold">{{ $materi->judul }}</h3>
        <p class="text-gray-600">{{ Str::limit($materi->deskripsi, 100) }}</p>
        <p class="text-sm text-gray-500">Diuplode oleh: <strong style="color: rgb(59 130 246);">{{ $materi->creator->name ?? 'Admin' }}</strong></p>
        <a href="{{ route('siswa.materi.show', $materi->id) }}" class="text-blue-500 hover:text-blue-700 transition duration-300 ease-in-out">📄 Lihat Materi</a>
    </div>
    @endforeach    

   
    <div class="mt-5 animate-fade-in">
        {{ $materis->appends(['sort' => request('sort')])->links() }}
    </div>
</div>
@endsection

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