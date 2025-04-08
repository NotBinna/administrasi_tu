<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Prodi;


class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $primaryKey = 'idUser';

    protected $fillable = [
        'idUser',
        'name',
        'alamat',
        'email',
        'password',
        'prodi_idProdi',
        'role_idRole',
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

    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'prodi_idProdi', 'idProdi');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_idRole', 'idRole');
    }

    public function surats()
    {
        return $this->hasMany(Surat::class, 'users_idUser', 'idUser');
    }



}
