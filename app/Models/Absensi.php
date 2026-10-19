<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    protected $table = 'absensi';
    protected $fillable = ['kegiatan_id', 'anggota_id', 'status', 'keterangan', 'waktu_absen'];

    protected $casts = ['waktu_absen' => 'datetime'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }

    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}