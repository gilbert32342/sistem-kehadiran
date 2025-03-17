<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Materi extends Model
{
    use HasFactory;

    protected $table = 'materis';

    protected $fillable = ['judul', 'deskripsi', 'file_path', 'created_by'];


    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
    
}
