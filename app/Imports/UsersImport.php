<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
            'name'     => $row['name'],
            'nis'      => $row['nis'] ?? null, // Hanya untuk siswa
            'nip'      => $row['nip'] ?? null, // Hanya untuk guru
            'password' => Hash::make($row['password']),
            'role'     => $row['role'], // siswa atau guru
            'kelas'    => $row['kelas'] ?? null, // Hanya siswa yang punya kelas
        ]);
    }
}
