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
            'nis'      => $row['nis'] ?? null, 
            'nip'      => $row['nip'] ?? null, 
            'password' => Hash::make($row['password']),
            'role'     => $row['role'], 
            'kelas'    => $row['kelas'] ?? null, 
        ]);
    }
}
