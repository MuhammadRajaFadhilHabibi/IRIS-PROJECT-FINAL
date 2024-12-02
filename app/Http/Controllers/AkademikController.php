<?php 
namespace App\Http\Controllers;

use App\Models\Irstest;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\DB;

class AkademikController extends Controller 
{
    public function index() 
    {
        $user = auth()->user();
        $email = $user->email;

        // Ambil data IRS yang disetujui
        $irsData = Irstest::select('semester', DB::raw('sum(sks) as total_sks'))
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk')
            ->where('irs_test.email', $email)
            ->groupBy('semester')
            ->get();

        $data = [
            'userName' => $user->name,
            'status' => $user->status,
            'irsData' => $irsData,
            'email' => $email,
        ];

        return view('mhsAkademik', compact('data'));
    }
}