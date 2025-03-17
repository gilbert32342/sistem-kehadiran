<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('materis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('created_by');
            $table->text('deskripsi');
            $table->string('file_path')->nullable();
            $table->timestamps();
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('materis');
    }
};
