<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Divisi extends Model
{
    protected $table = 'divisi';
    protected $fillable = ['nama', 'slug', 'deskripsi'];

    public function anggota()
    {
        return $this->hasMany(Anggota::class);
    }

    public function kegiatan()
    {
        return $this->hasMany(Kegiatan::class);
    }
}