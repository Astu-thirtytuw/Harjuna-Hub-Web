<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'user_id', 'nik', 'nama', 'jenis_kelamin', 'tanggal_lahir',
        'tempat_lahir', 'alamat', 'rt', 'rw', 'no_hp', 'email', 'foto',
        'divisi_id', 'jabatan', 'status', 'tanggal_gabung',
    ];

    protected $casts = [
        'tanggal_lahir' => 'date',
        'tanggal_gabung' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function divisi()
    {
        return $this->belongsTo(Divisi::class);
    }

    public function absensi()
    {
        return $this->hasMany(Absensi::class);
    }

    public function iuran()
    {
        return $this->hasMany(Iuran::class);
    }

    public function kegiatanDiampu()
    {
        return $this->hasMany(Kegiatan::class, 'penanggung_jawab');
    }

    // Scope: hanya anggota aktif
    public function scopeAktif($query)
    {
        return $query->where('status', 'aktif');
    }
}