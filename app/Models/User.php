<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

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
    // POIN 6: Query Scopes (Local Scope)
    // Berfungsi untuk membuat template query yang bisa dipakai berulang kali
    public function scopeTerbaru($query)
    {
        return $query->orderBy('created_at', 'desc');
    }

    // POIN 3: Accessors (Mengubah format data saat ditampilkan)
    // Berfungsi menggabungkan nama dan email untuk tampilan
    public function getProfilLengkapAttribute()
    {
        return $this->name . ' (' . $this->email . ')';
    }
}
