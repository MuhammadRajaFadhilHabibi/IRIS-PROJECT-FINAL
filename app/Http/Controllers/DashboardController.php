<?php

namespace App\Http\Controllers;

use App\Models\Irstest;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
    
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
    
        // Ambil data mahasiswa
        $userName = $user->name;
        $status = $user->status;
        $ipk = $mahasiswa->ipk; 
        $semester_berjalan = $mahasiswa->semester_berjalan;
    
        // Pengambilan data dari irstest
        $total_sks = DB::table('irs_test')
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk')
            ->select('mata_kuliah.sks')
            ->where('email', $user->email)
            ->where('status', 'Disetujui')
            ->sum('sks');
    
        // Pengiriman data ke view
        $data = [
            'userName' => $userName,
            'nim' => $mahasiswa->nim,
            'prodi' => $user->prodi,
            'semester_berjalan' => $semester_berjalan,
            'status' => $status,
            'ipk' => $ipk, 
            'total_sks' => $total_sks,  
        ];
    
        $todayNumber = date('N');
        $jadwalhariini = DB::table('jadwal')
            ->join('mata_kuliah', 'jadwal.kodemk', '=', 'mata_kuliah.kodemk')
            ->join('irs_test', 'jadwal.id', '=', 'irs_test.kodejadwal')
            ->select('jadwal.kodemk', 'mata_kuliah.nama', 'jadwal.kelas', 'jadwal.hari', 'jadwal.jammulai', 'jadwal.jamselesai', 'jadwal.ruang')
            ->where('jadwal.hari', $todayNumber)
            ->where('irs_test.email', $user->email)
            ->where('irs_test.status', 'Disetujui')
            ->orderBy('jadwal.jammulai')
            ->get();
    
        // Pembuatan jam dimana menggunakan indexing, jam start dan jam end
        $jamend = [
            "" => '',
            1 => '07.50',
            2 => '08.40',
            3 => '09.30',
            4 => '10.30',
            5 => '11.20',
            6 => '12.10',
            7 => '13.00',
            8 => '13.50',
            9 => '14.40',
            10 => '15.40',
            11 => '16.30',
            12 => '17.20',
            13 => '18.10',
        ];
    
        $jamstart = [
            "" => '',
            0 => '07.00',
            1 => '07.50',
            2 => '08.40',
            3 => '09.40',
            4 => '10.30',
            5 => '11.20',
            6 => '12.10',
            7 => '13.00',
            8 => '13.50',
            9 => '14.40',
            10 => '15.40',
            11 => '16.30',
        ];
        // Update waktu mulai dan selesai
        foreach ($jadwalhariini as $d) {
            $d->jammulai = $jamstart[$d->jammulai];
            $d->jamselesai = $jamend[$d->jamselesai];
        }
        return view('MhsDashboard', compact('data', 'jadwalhariini'));
    }
    
    public function index2()
    {
        $user = auth()->user();
        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];

        return view('paDashboard',compact('data'));
    }

    public function index3()
    {
        $user = auth()->user();
        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];
        return view('MhsDashboard',compact('data'));
    }
    public function index4()
    {
        $user = auth()->user();

        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];

        return view('MhsDashboard',compact('data'));
    }
}
