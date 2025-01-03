<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dosen extends Model
{
    use HasFactory;

    protected $table = 'dosen';

    protected $fillable = [
        'nip',
        'nama',
        'email',
        'no_telp',
    ];

    public function mahasiswa()
    {
        return $this->hasMany(Mahasiswa::class, 'nip_doswal', 'nip');
    }
    
}
