<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    protected $table = 'surat';
    protected $primaryKey = 'idSurat';
    public $incrementing = true;
    protected $keyType = 'int';
    protected $guarded = [];

    public function mahasiswa()
    {
        return $this->belongsTo(User::class, 'users_idUser', 'idUser');
    }
}
