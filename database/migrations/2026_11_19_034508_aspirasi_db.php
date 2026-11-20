<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('aspirasi_db', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama', 255);
            $table->string('prodi', 255);
            $table->string('kontak');
            $table->string('jenis_aspirasi', 255);
            $table->text('aspirasi');
            $table->date('waktu_kejadian');
            $table->json('bukti_files');
            $table->date('submitted_at');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('aspirasi_db');
    }
};
