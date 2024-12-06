<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Irstest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Matakuliah;
use App\Models\Mahasiswa;
use Barryvdh\DomPDF\Facade\Pdf;

class IrsController extends Controller
{
    public function all()
    {
        $email = auth()->user()->email;
        // Join table mahasiswa dengan semester dan penjumlahan sks
        $data = Irstest::select('semester', DB::raw('sum(sks) as total_sks'))
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk')
            ->join('mahasiswa', 'irs_test.email', '=', 'mahasiswa.email')
            ->where('irs_test.email', $email)
            ->where('irs_test.status', 'Disetujui')
            ->groupBy('semester')
            ->get();
        return view('mhsIrs', compact('data', 'email'));
    }

    public function index(Request $request, $semester, $email)
    {
        // Get daftar dari semester di matakuliaj yang dipilih
        $query = "SELECT m.kodemk as kodemk, 
                        m.nama as mata_kuliah, 
                        j.ruang as ruang, 
                        m.sks as sks 
                FROM irs_test i 
                JOIN mata_kuliah m ON i.kodemk = m.kodemk 
                JOIN jadwal j ON i.kodejadwal = j.id  
                JOIN mahasiswa ma ON ma.email = i.email 
                WHERE ma.email = '" . $email . "'
                AND i.status = 'Disetujui'  
                AND i.semester=" . $semester . "";
        $data = DB::select($query);

        foreach ($data as $key => $value) {
            $value->dosen = DB::select('SELECT d.nama FROM dosen d JOIN dosen_matakuliah dm ON d.nip = dm.nip WHERE dm.kodemk = "' . $value->kodemk . '"');
        }

        //change data to object
        $data = json_decode(json_encode($data));
        return response()->json(['data' => $data]);



        if ($request->ajax()) {
            return response()->json($data);
        }

    }

    public function downloadIrs()
    {
        $email = auth()->user()->email;

        // Ambil data IRS yang sudah disetujui berdasarkan email pengguna
        $irsData = Irstest::select('irs_test.*', 'mahasiswa.nama', 'mahasiswa.nim', 'mahasiswa.prodi', 'mahasiswa.semester_berjalan')
            ->join('mahasiswa', 'irs_test.email', '=', 'mahasiswa.email')
            ->where('irs_test.email', $email)
            ->where('irs_test.status', 'Disetujui')
            ->get();

        if ($irsData->isEmpty()) {
            return redirect()->back()->with('error', 'Data IRS yang disetujui tidak ditemukan.');
        }

        // Ambil daftar mata kuliah terkait
        $mataKuliah = DB::table('mata_kuliah')
            ->whereIn('kodemk', $irsData->pluck('kodemk'))
            ->get();

        // Data yang akan dikirim ke view PDF
        $dataForPdf = [
            'nama' => $irsData[0]->nama,
            'nim' => $irsData[0]->nim,
            'prodi' => $irsData[0]->prodi,
            'semester_berjalan' => $irsData[0]->semester_berjalan,
            'mataKuliah' => $mataKuliah
        ];

        // Render view ke PDF
        $pdf = Pdf::loadView('pdf.irs', compact('dataForPdf'));

        // Unduh PDF dengan nama file tertentu
        return $pdf->download('IRS_' . $irsData[0]->nim . '.pdf');
    }

}
