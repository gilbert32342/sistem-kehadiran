<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $table = 'absensis'; 

    protected $fillable = ['user_id', 'siswa_id', 'status', 'tanggal', 'role','nama','nis','kelas','nip'];

    
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    
    public function siswa()
    {
    return $this->hasMany(Absensi::class, 'siswa_id', 'id');
    }


    
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
