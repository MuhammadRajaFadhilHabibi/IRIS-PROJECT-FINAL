<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DosenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $dosen = [
            ['nip' => '1234567890', 'nama' => 'indana', 'email' => 'indana@gmail.com', 'no_telp' => '08544329423'],
            ['nip' => '1234567891', 'nama' => 'Chandra', 'email' => 'chandra@gmail.com', 'no_telp' => '085324332434'],
            ['nip' => '1234567892', 'nama' => 'Akbar', 'email' => 'akbar@gmail.com', 'no_telp' => '08523424242'],
            ['nip' => '1234567893', 'nama' => 'Raja', 'email' => 'raja@gmail.com', 'no_telp' => '0852342342342'],
            ['nip' => '1234567894', 'nama' => 'Rusdi Ganteng', 'email' => 'rusdi@gmail.com', 'no_telp' => '08534234234'],
        ];

        DB::table('dosen')->insert($dosen);
    }
}
