<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prodi extends Model
{
    protected $table = 'prodi';
    protected $primaryKey = 'idProdi';
    public $timestamps = true;

    protected $fillable = [
        'nama_prodi',
    ];

    // Relasi ke User
    public function users()
    {
        return $this->hasMany(User::class, 'prodi_idProdi', 'idProdi');
    }
}
