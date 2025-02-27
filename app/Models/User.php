<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class User extends Authenticatable
{
    use HasFactory;

    // Kolom yang bisa diisi
    protected $fillable = [
        'name', 'nis', 'nip', 'password', 'role', 'kelas', // ✅ Tambahkan 'kelas'
    ];

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public function isGuru() {
        return $this->role === 'guru';
    }

    public function isSiswa() {
        return $this->role === 'siswa';
    }

    public function absensis()
    {
    return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }

    
}
