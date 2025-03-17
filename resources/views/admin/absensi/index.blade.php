@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Rekap Absensi Siswa</h2>

    <table>
        <tr>
            <th>Nama Siswa</th>
            <th>Tanggal</th>
            <th>Status</th>
        </tr>
        @foreach ($absensi as $item)
        <tr>
            <td>{{ $item->siswa->name }}</td>
            <td>{{ $item->tanggal }}</td>
            <td>{{ $item->status }}</td>
        </tr>
        @endforeach
    </table>
</div>
@endsection
