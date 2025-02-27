@extends('layouts.app')

@section('page_title', 'Statistik Kehadiran')

@section('content')
<div class="container mx-auto p-6">

    <!-- Title and Subtitle -->
    <h2 class="text-3xl font-semibold text-gray-800 mb-6">Statistik Kehadiran</h2>

    <!-- Pilih Periode -->
    <div class="flex mb-8 items-center">
        <label for="periode" class="mr-4 text-lg font-medium text-gray-700">Pilih Periode:</label>
        <select id="periode" class="border rounded-md px-4 py-2 text-lg focus:outline-none focus:ring-2 focus:ring-indigo-600">
            <option value="harian">Harian</option>
            <option value="mingguan">Mingguan</option>
            <option value="bulanan">Bulanan</option>
        </select>
    </div>

<!-- Statistik Box -->
<div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
    <!-- Box untuk Hadir -->
    <div class="bg-green-100 rounded-lg shadow-xl p-6 flex items-center">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10l7 7 7-7" />
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-2xl font-semibold text-gray-800">Hadir</h3>
            <p class="text-xl text-green-600">{{ $totalHadir }} Siswa</p>
        </div>
    </div>
    <!-- Box untuk Izin -->
    <div class="bg-yellow-100 rounded-lg shadow-xl p-6 flex items-center">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h7l-3 3m0 0l3 3m-3-3l-3-3M7 8h4.5L10 3m-2 5h-3m1 0V3h4v6H7zm3 0V6m0 2V5m0 5h3v7H7V9" />
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-2xl font-semibold text-gray-800">Izin</h3>
            <p class="text-xl text-yellow-600">{{ $totalIzin }} Siswa</p>
        </div>
    </div>
    <!-- Box untuk Sakit -->
    <div class="bg-red-100 rounded-lg shadow-xl p-6 flex items-center">
        <div class="flex-shrink-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16" />
            </svg>
        </div>
        <div class="ml-4">
            <h3 class="text-2xl font-semibold text-gray-800">Sakit</h3>
            <p class="text-xl text-red-600">{{ $totalSakit }} Siswa</p>
        </div>
    </div>
</div>


    <!-- Grafik Statistik Kehadiran -->
    <div class="mb-6 bg-white rounded-lg shadow-lg p-6">
        <canvas id="attendanceChart" width="400" height="200"></canvas>
    </div>

    <!-- Tabel Kehadiran -->
    <div class="overflow-x-auto bg-white rounded-lg shadow-lg">
        <h3 class="text-2xl font-semibold text-gray-800 mb-4 px-6 py-3">Tabel Kehadiran</h3>
        <table class="w-full border-separate border-spacing-0">
            <thead>
                <tr class="bg-gradient-to-r from-indigo-600 to-indigo-400 text-white">
                    <th class="p-3 text-left">Tanggal</th>
                    <th class="p-3 text-left">Hadir</th>
                    <th class="p-3 text-left">Izin</th>
                    <th class="p-3 text-left">Sakit</th>
                    <th class="p-3 text-left">Alpha</th>
                </tr>
            </thead>
            <tbody>
                @foreach($attendanceData as $data)
                <tr class="hover:bg-gray-100 transition duration-300 ease-in-out">
                    <td class="p-3">{{ $data->tanggal }}</td>
                    <td class="p-3">{{ $data->hadir }}</td>
                    <td class="p-3">{{ $data->izin }}</td>
                    <td class="p-3">{{ $data->sakit }}</td>
                    <td class="p-3">{{ $data->alpha }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Ambil data statistik dari controller
    const attendanceData = @json($attendanceData);
    const labels = attendanceData.map(item => item.tanggal);
    const hadir = attendanceData.map(item => item.hadir);
    const izin = attendanceData.map(item => item.izin);
    const sakit = attendanceData.map(item => item.sakit);
    const alpha = attendanceData.map(item => item.alpha);

    // Inisialisasi grafik
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [
                {
                    label: 'Hadir',
                    data: hadir,
                    borderColor: 'rgba(34, 197, 94, 1)',
                    fill: false,
                    tension: 0.4, // membuat garis lebih smooth
                },
                {
                    label: 'Izin',
                    data: izin,
                    borderColor: 'rgba(255, 193, 7, 1)',
                    fill: false,
                    tension: 0.4,
                },
                {
                    label: 'Sakit',
                    data: sakit,
                    borderColor: 'rgba(220, 38, 38, 1)',
                    fill: false,
                    tension: 0.4,
                },
                {
                    label: 'Alpha',
                    data: alpha,
                    borderColor: 'rgba(156, 163, 175, 1)',
                    fill: false,
                    tension: 0.4,
                },
            ],
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'top',
                    labels: {
                        font: {
                            size: 14,
                        },
                    },
                },
                tooltip: {
                    callbacks: {
                        label: function(tooltipItem) {
                            return tooltipItem.raw;
                        }
                    }
                }
            },
            scales: {
                x: {
                    ticks: {
                        font: {
                            size: 12,
                        }
                    },
                },
                y: {
                    ticks: {
                        font: {
                            size: 12,
                        }
                    },
                },
            }
        }
    });
</script>
@endpush
