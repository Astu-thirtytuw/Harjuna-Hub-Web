<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Dokumentasi extends Model
{
    protected $table = 'dokumentasi';
    protected $fillable = ['kegiatan_id', 'file', 'tipe', 'caption'];

    public function kegiatan()
    {
        return $this->belongsTo(Kegiatan::class);
    }
}