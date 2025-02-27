<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    protected $fillable = ['judul', 'deskripsi', 'file_path', 'created_by'];

    // ✅ Relasi ke tabel users (untuk mengetahui siapa pembuat materi)
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
