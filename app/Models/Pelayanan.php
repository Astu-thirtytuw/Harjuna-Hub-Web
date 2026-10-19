<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pelayanan extends Model
{
    protected $table = 'pelayanan';

    protected $fillable = [
        'kode_tiket', 'nama_pelapor', 'nik', 'no_hp', 'email',
        'kategori', 'judul', 'deskripsi', 'lokasi', 'foto',
        'status', 'ditangani_oleh', 'ditangani_pada',
    ];

    protected $casts = ['ditangani_pada' => 'datetime'];

    public function penangan()
    {
        return $this->belongsTo(User::class, 'ditangani_oleh');
    }

    public function tanggapan()
    {
        return $this->hasMany(TanggapanLapor::class);
    }

    public function scopeBaru($query)  { return $query->where('status', 'baru'); }
    public function scopeSelesai($query) { return $query->where('status', 'selesai'); }
}