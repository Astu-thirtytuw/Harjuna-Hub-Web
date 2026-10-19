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
        Schema::create('kegiatan', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('slug')->unique();
            $table->text('deskripsi')->nullable();
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai')->nullable();
            $table->time('waktu_mulai')->nullable();
            $table->time('waktu_selesai')->nullable();
            $table->string('lokasi')->nullable();
            $table->string('gambar')->nullable();
            $table->foreignId('divisi_id')->nullable()->constrained('divisi')->nullOnDelete();
            $table->foreignId('penanggung_jawab')->nullable()->constrained('anggota')->nullOnDelete();
            $table->enum('status', ['draft', 'publish', 'selesai', 'batal'])->default('draft');
            $table->boolean('is_publik')->default(true); // tampil di web publik?
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kegiatan');
    }
};
