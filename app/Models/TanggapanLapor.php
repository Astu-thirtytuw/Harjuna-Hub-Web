<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TanggapanLapor extends Model
{
    protected $table = 'tanggapan_lapor';
    protected $fillable = ['pelayanan_id', 'user_id', 'isi'];

    public function pelayanan()
    {
        return $this->belongsTo(Pelayanan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}