<?php

namespace App\Http\Controllers;

use App\Models\Irstest;
use App\Models\Jadwal;
use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    //

    public function index()
    {
        // Get the authenticated user
        $user = auth()->user();
    
        // Query mahasiswa berdasarkan email pengguna
        $mahasiswa = Mahasiswa::where('email', $user->email)->first();
    
        // Ambil data mahasiswa
        $userName = $user->name;
        $status = $user->status;
        $ipk = $mahasiswa->ipk;  // Perbaikan: Gunakan $mahasiswa->ipk
        $semester_berjalan = $mahasiswa->semester_berjalan;  // Perbaikan: Gunakan $mahasiswa->semester_berjalan
    
        // Ambil total SKS dari tabel irs_test
        $total_sks = DB::table('irs_test')
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk')
            ->select('mata_kuliah.sks')
            ->where('email', $user->email)
            ->where('status', 'Disetujui')
            ->sum('sks');
    
        // Kirim data ke view
        $data = [
            'userName' => $userName,
            'nim' => $mahasiswa->nim,
            'prodi' => $user->prodi,
            'semester_berjalan' => $semester_berjalan,
            'status' => $status,
            'ipk' => $ipk,  // Pastikan IPK sudah benar
            'total_sks' => $total_sks,  // Total SKS
        ];
    
        // Ambil jadwal hari ini
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
    
        // Define jam mulai dan selesai
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
    
        // Update waktu mulai dan selesai pada jadwal
        foreach ($jadwalhariini as $d) {
            $d->jammulai = $jamstart[$d->jammulai];
            $d->jamselesai = $jamend[$d->jamselesai];
        }
    
        // Return view dengan data yang dikirim
        return view('MhsDashboard', compact('data', 'jadwalhariini'));
    }
    
    public function index2()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Access user name
        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];

        // Pass the user data to a view, or return a response
        return view('paDashboard',compact('data'));
    }
    public function index3()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Access user name
        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];

        // Pass the user data to a view, or return a response
        return view('MhsDashboard',compact('data'));
    }
    public function index4()
    {
        // Get the authenticated user
        $user = auth()->user();

        // Access user name
        $userName = $user->name;
        $status = $user->status;

        $data = [
            'userName' => $userName,
            'status' => $status
        ];

        // Pass the user data to a view, or return a response
        return view('MhsDashboard',compact('data'));
    }
}