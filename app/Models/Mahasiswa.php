<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mahasiswa extends Model
{
    use HasFactory;

    protected $table = 'mahasiswa';

    protected $fillable = [
        'nim',
        'nama',
        'email',
        'no_telp',
        'jenis_kelamin',
        'tanggal_lahir',
        'prodi',
        'jalur_masuk',
        'angkatan',
        'ipk',
        'alamat',
        'status',
        'nip_doswal',
        'status_irs',
    ];

    public function dosen()
    {
        return $this->belongsTo(Dosen::class, 'nip_doswal', 'nip');
    }
}
