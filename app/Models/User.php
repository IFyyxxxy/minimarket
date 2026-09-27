<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    // ==========================================
    // TAMBAHAN KODE UNTUK ACARA 18 & 19
    // ==========================================

    // Query Scope: Mengambil data terbaru
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // Query Scope: Mengambil data aktif
    public function scopeActive($query)
    {
        return $query->where('email', 'LIKE', '%@example.com%');
    }

    // Accessor: Menggabungkan nama dan email untuk tampilan
    public function getProfilLengkapAttribute()
    {
        return $this->name . ' (' . $this->email . ')';
    }

    // Accessor: Format nama lengkap
    public function getFullNameAttribute()
    {
        return $this->name . ' (Akun Terverifikasi)';
    }

    // Mutator: Mengubah password otomatis sebelum disimpan
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }
}