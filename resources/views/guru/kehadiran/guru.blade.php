@extends('layouts.guru')

@section('content')
<div class="p-5 animate-fade-in">
    <h2 class="text-2xl font-bold mt-4 mb-2 text-gray-800 animate-fade-in-up">📜 Riwayat Kehadiran Guru</h2>

    <p class="text-lg font-semibold text-gray-700 mb-4 animate-fade-in-up">👤 Nama: {{ $guru->name }}</p>

    <div class="overflow-x-auto bg-white shadow-lg rounded-lg p-4 animate-fade-in-up">
        <table class="table-auto w-full border-collapse border">
            <thead>
                <tr class="bg-gray-100">
                    <th class="border p-3 text-left text-gray-700">Tanggal</th>
                    <th class="border p-3 text-left text-gray-700">Status</th>
                    <th class="border p-3 text-left text-gray-700">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($kehadiran as $data)
                <tr class="hover:bg-gray-50 transition duration-200">
                    <td class="border p-3 text-gray-600">{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    <td class="border p-3 text-gray-600">
                        @if($data->status == 'hadir')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-green-100 text-green-700">✅ Hadir</span>
                        @elseif($data->status == 'izin')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-yellow-100 text-yellow-700">🟡 Izin</span>
                        @elseif($data->status == 'sakit')
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-orange-100 text-orange-700">🟠 Sakit</span>
                        @else
                            <span class="inline-flex items-center px-3 py-1 rounded-full bg-red-100 text-red-700">❌ Alpha</span>
                        @endif
                    </td>
                    <td class="border p-3 text-gray-600">{{ $data->jumlah }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    
    <div class="mt-5 mb-4 flex justify-between items-center w-full animate-fade-in-up">
    
        
        <a href="{{ route('guru.kehadiran.exportGuruExcel') }}" 
            class="bg-green-600 text-white py-2 px-4 rounded-md hover:bg-green-700 transition duration-200 flex items-center transform hover:scale-105">
            📤 Ekspor Kehadiran Guru
        </a>
    </div>

    
    <div class="mt-5 animate-fade-in">
        {{ $kehadiran->links('pagination::tailwind') }}
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