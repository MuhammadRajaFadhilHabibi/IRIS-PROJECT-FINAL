<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MahasiswaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mahasiswa')->insert([
            [
                'nim' => '24060120140174',
                'nama' => 'Aryela Rachma Davina',
                'email' => 'yela@gmail.com',
                'no_telp' => '085999999999',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2002-06-17',
                'prodi' => 'Informatika',
                'jalur_masuk' => 'Mandiri',
                'angkatan' => 2021,
                'ipk' => 3.5,
                'semester_berjalan' => 7,
                'nip_doswal' => '1234567890',
                'alamat' => 'Jl. Sigar Bencah',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060122130070',
                'nama' => 'Indana Najwa Ramadhani',
                'email' => 'indananajwa@gmail.com',
                'no_telp' => '0851919199191',
                'jenis_kelamin' => 'P',
                'tanggal_lahir' => '2004-05-11',
                'prodi' => 'Matematika',
                'jalur_masuk' => 'SBMPTN',
                'angkatan' => 2022,
                'ipk' => 3.5,
                'semester_berjalan' => 5,
                'nip_doswal' => '1234567890',
                'alamat' => 'Jl. Sigar Bencah',
                'status' => 'Aktif',
            ],
            [
                'nim' => '24060122140131',
                'nama' => 'Muhammad Raja Fadhil Habibi',
                'email' => 'rajafadhil@gmail.com',
                'no_telp' => '085338182967',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2003-01-05',
                'prodi' => 'Informatika',
                'jalur_masuk' => 'Mandiri',
                'angkatan' => 2023,
                'ipk' => 3.6,
                'semester_berjalan' => 3,
                'nip_doswal' => '1234567890',
                'alamat' => 'Jl. Kos The Bayu Gondang Keren',
                'status' => 'Aktif',
            ],
            [
                'nim' => '2022010005',
                'nama' => 'Riski AKbar Firmansyah',
                'email' => 'riskiakbar@gmail.com',
                'no_telp' => '08523429334293',
                'jenis_kelamin' => 'L',
                'tanggal_lahir' => '2002-05-19',
                'prodi' => 'Fisika',
                'jalur_masuk' => 'MANDIRI',
                'angkatan' => 2022,
                'ipk' => 3.4,
                'semester_berjalan' => 5,
                'nip_doswal' => '1234567890',
                'alamat' => 'Jl. kos hijau',
                'status' => 'Aktif',
            ],
        ]);
    }
}
