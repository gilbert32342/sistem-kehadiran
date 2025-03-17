@extends('layouts.admin')

@section('page_title', 'Statistik Kehadiran')

@section('content')
<div class="container mx-auto p-6">
    <h2 class="text-2xl font-bold mb-4">Statistik Kehadiran</h2>

    <!-- Statistik Siswa & Guru -->
    <div class="grid grid-cols-2 gap-4 mb-6">
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Kehadiran Siswa</h3>
            <p class="text-2xl font-bold">{{ $totalSiswaHadir }}</p>
        </div>
        <div class="bg-white p-4 rounded-lg shadow-md">
            <h3 class="text-lg font-semibold">Total Kehadiran Guru</h3>
            <p class="text-2xl font-bold">{{ $totalGuruHadir }}</p>
        </div>
    </div>

    <!-- Grafik Kehadiran -->
    <div class="bg-white p-6 rounded-lg shadow-md">
        <h3 class="text-lg font-semibold mb-4">Grafik Kehadiran</h3>
        <canvas id="attendanceChart"></canvas>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('attendanceChart').getContext('2d');
    const attendanceChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: @json($labels),
            datasets: [
                {
                    label: 'Siswa',
                    data: @json($dataSiswa),
                    backgroundColor: 'rgba(54, 162, 235, 0.5)'
                },
                {
                    label: 'Guru',
                    data: @json($dataGuru),
                    backgroundColor: 'rgba(255, 99, 132, 0.5)'
                }
            ]
        }
    });
</script>
@endsection
