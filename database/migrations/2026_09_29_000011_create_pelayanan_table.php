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
        Schema::create('pelayanan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_tiket')->unique(); // HRJ-2025-0001
            $table->string('nama_pelapor');
            $table->string('nik', 20)->nullable();
            $table->string('no_hp', 20);
            $table->string('email')->nullable();
            $table->enum('kategori', [
                'infrastruktur', 'keamanan', 'kebersihan',
                'sosial', 'usulan_kegiatan', 'lainnya'
            ]);
            $table->string('judul');
            $table->text('deskripsi');
            $table->string('lokasi')->nullable();
            $table->string('foto')->nullable();
            $table->enum('status', ['baru', 'diverifikasi', 'diproses', 'selesai', 'ditolak'])
                ->default('baru');
            $table->foreignId('ditangani_oleh')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('ditangani_pada')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pelayanan');
    }
};
