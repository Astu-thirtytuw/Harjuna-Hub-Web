<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Keuangan extends Model
{
    protected $table = 'keuangan';

    protected $fillable = [
        'jenis', 'kategori_id', 'jumlah', 'tanggal',
        'sumber', 'keterangan', 'bukti', 'dicatat_oleh',
    ];

    protected $casts = [
        'tanggal' => 'date',
        'jumlah' => 'decimal:2',
    ];

    public function kategori()
    {
        return $this->belongsTo(KategoriKeuangan::class, 'kategori_id');
    }

    public function pencatat()
    {
        return $this->belongsTo(User::class, 'dicatat_oleh');
    }

    public function scopeMasuk($query)  { return $query->where('jenis', 'masuk'); }
    public function scopeKeluar($query) { return $query->where('jenis', 'keluar'); }
}