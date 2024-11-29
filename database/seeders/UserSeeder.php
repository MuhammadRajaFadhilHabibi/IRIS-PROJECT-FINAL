<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            ['name' => 'Aryela', 'email' => 'aryela@gmail.com', 'password' => '12345', 'role' => 'Mahasiswa', 'prodi'=> 'Informatika', 'mhs'=>1, 'status' => 'Non Aktif'],
            ['name' => 'Aryela Rachma Davina', 'email' => 'yela@gmail.com', 'password' => '12345', 'role' => 'Mahasiswa', 'prodi'=> 'Informatika', 'mhs'=>1, 'status' => 'Aktif'],
            ['name' => 'Indana Najwa Ramadhani', 'email' => 'indananajwagmail.com', 'password' => '12345', 'role' => 'Mahasiswa', 'prodi'=> 'Informatika', 'mhs'=>1, 'status' => 'Aktif'],
            ['name' => 'Muhammad Raja Fadhil Habibi', 'email' => 'rajafadhil@gmail.com', 'password' => '12345', 'role' => 'Mahasiswa', 'prodi'=> 'Informatika', 'mhs'=>1, 'status' => 'Aktif'],
            ['name' => 'Riski Akbar Firmansyah', 'email' => 'riskiakbar@gmail.com', 'password' => '12345', 'role' => 'Mahasiswa', 'prodi'=> 'Informatika', 'mhs'=>1, 'status' => 'Aktif'],
            ['name' => 'indana', 'email' => 'indana@gmail.com', 'password' => '12345', 'role' => 'Pembimbing Akademik', 'prodi' => 'Informatika', 'pa'=>1],
            ['name' => 'Chandra Wijayakusuma', 'email' => 'chandra@gmail.com', 'password' => '12345', 'role' => 'Kaprodi', 'prodi' => 'Informatika', 'kp'=>1, 'dk'=>1],
            ['name' => 'Akbar', 'email' => 'akbar@gmail.com', 'password' => '12345', 'role' => 'Kaprodi', 'prodi' => 'Informatika', 'kp'=>1],
            ['name' => 'Riski Akbar ', 'email' => 'akbar1@gmail.com', 'password' => '12345', 'role' => 'Kaprodi', 'prodi' => 'Fisika', 'kp'=>1],
            ['name' => 'Raja', 'email' => 'raja@gmail.com', 'password' => '12345', 'role' => 'Dekan', 'prodi' => 'Informatika', 'dk'=>1],
            ['name' => 'Rusdi Ganteng', 'email' => 'rusdi@gmail.com', 'password' => '12345', 'role' => 'BA', 'prodi' => 'Informatika', 'ba'=>1],
        ];

        foreach ($user as $p) {
            $p['password'] = Hash::make($p['password']); // Hash the password
            User::create($p);
        }
    }
}
