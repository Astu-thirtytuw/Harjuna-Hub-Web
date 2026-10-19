<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    protected $table = 'kegiatan';

    protected $fillable = [
        'nama', 'slug', 'deskripsi', 'tanggal_mulai', 'tanggal_selesai',
        'waktu_mulai', 'waktu_selesai', 'lokasi', 'gambar',
        'divisi_id', 'penanggung_jawab', 'status', 'is_publik',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'is_publik' => 'boolean',
    ];

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function penanggungJawab()
    {
        return $this->belongsTo(Anggota::class, 'penanggung_jawab');
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function dokumentasi()
    {
        return $this->hasMany(Dokumentasi::class);
    }

    public function scopePublish($query)
    {
        return $query->where('status', 'publish')->where('is_publik', true);
    }
}