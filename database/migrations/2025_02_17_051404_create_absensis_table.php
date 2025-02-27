<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('absensis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->string('nip')->nullable();
            $table->enum('role', ['siswa', 'guru'])->default('siswa');
            $table->string('nis')->index();
            $table->string('nama');
            $table->string('kelas')->nullable();
            $table->enum('status', ['hadir', 'izin', 'sakit', 'alpha']);
            $table->integer('jumlah')->default(1);
            $table->date('tanggal')->default(now());
            $table->foreignId('siswa_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('absensis');
    }
};
