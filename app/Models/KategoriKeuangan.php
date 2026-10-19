<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KategoriKeuangan extends Model
{
    protected $table = 'kategori_keuangan';
    protected $fillable = ['nama', 'jenis'];

    public function keuangan()
    {
        return $this->hasMany(Keuangan::class, 'kategori_id');
    }
}