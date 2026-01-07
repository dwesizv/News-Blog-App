<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable implements MustVerifyEmail
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'rol'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    function blogs(): HasMany {
        return $this->hasMany('App\Models\Blog', 'iduser');
    }

    function comments(): HasMany {
        return $this->hasMany('App\Models\Comment', 'iduser');
    }

    function isRol($rol): bool {
        return $this->rol == $rol;
    }

    function isAdmin(): bool {
        //return $this->rol === 'admin';
        return $this->isRol('admin');
    }

    function isAdvanced(): bool {
        //return $this->rol === 'advanced';
        return $this->isRol('advanced');
    }

    function isUser(): bool {
        //return $this->rol === 'user';
        return $this->isRol('user');
    }
}