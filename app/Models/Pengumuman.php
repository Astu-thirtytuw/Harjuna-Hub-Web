<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pengumuman extends Model
{
    protected $table = 'pengumuman';

    protected $fillable = [
        'judul', 'slug', 'ringkasan', 'isi', 'gambar',
        'kategori', 'is_publik', 'published_at', 'penulis_id',
    ];

    protected $casts = [
        'is_publik' => 'boolean',
        'published_at' => 'datetime',
    ];

    public function penulis()
    {
        return $this->belongsTo(User::class, 'penulis_id');
    }

    public function scopePublik($query)
    {
        return $query->where('is_publik', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }
}