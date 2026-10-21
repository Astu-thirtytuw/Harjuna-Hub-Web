<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users';

        protected $fillable = [
        'nama',
        'email',
        'no_hp',
        'password',
        'role_id',
        'is_aktif',
        'foto', 
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'is_aktif' => 'boolean',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function anggota()
    {
        return $this->hasOne(Anggota::class);
    }

    public function hasRole(string ...$slugs): bool
    {
        return in_array($this->role->slug ?? '', $slugs);
    }
}