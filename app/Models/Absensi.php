<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis'; // Nama tabel sesuai database

    protected $fillable = ['user_id', 'siswa_id', 'status', 'tanggal', 'role','nama','nis','kelas','nip'];

    // Relasi ke User (Bisa Siswa atau Guru)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke Siswa
    public function siswa()
    {
    return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }


    // Fungsi untuk mendapatkan status kehadiran dengan ikon
    public function getStatusTextAttribute()
    {
        $icon = match ($this->status) {
            'hadir' => '✅',
            'izin' => '🟡',
            'sakit' => '🟠',
            'alpha' => '❌',
            default => '❓'
        };

        return "{$icon} {$this->status} (" . ucfirst($this->role) . ")";
    }
}
