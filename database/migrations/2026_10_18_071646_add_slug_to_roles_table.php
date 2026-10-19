<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            // Cek dulu, kalau belum ada kolom slug, kita tambahkan
            if (!Schema::hasColumn('roles', 'slug')) {
                $table->string('slug')->nullable()->after('nama');
            }
        });
    }

    public function down(): void
    {
        Schema::table('roles', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};