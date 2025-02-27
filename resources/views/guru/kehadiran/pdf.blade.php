<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Laporan Kehadiran Siswa</title>
    <style>
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid black; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
    </style>
</head>
<body>
    <h2>Laporan Kehadiran Siswa</h2>
    <table>
        <thead>
            <tr>
                <th>Nama</th>
                <th>NIS</th>
                <th>Kelas</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach($absensi as $data)
            <tr>
                <td>{{ $data->nama }}</td>
                <td>{{ $data->nis }}</td>
                <td>{{ $data->kelas }}</td>
                <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                <td>{{ ucfirst($data->status) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
