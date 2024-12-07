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

    public function downloadIrsForDosen()
    {
        $irsData = Irstest::all(); // Atau query sesuai kebutuhan
        if ($irsData->isEmpty()) {
            return response()->json(['error' => 'Tidak ada data IRS'], 404);
        }

        $pdf = Pdf::loadView('pdf.irs', ['data' => $irsData]);
        return response()->view('pdf.irs', compact('dataForPdf'));

        return $pdf->download('IRS_Akademik.pdf');
    }

    public function approveIrs(Request $request)
    {
        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        // Update status IRS di tabel mahasiswa
        $mahasiswa->status_irs = 'Disetujui';
        $mahasiswa->save();

        // Update status IRS di tabel irs_test untuk mahasiswa tersebut
        Irstest::where('email', $request->email)
            ->update(['status' => 'Disetujui']);

        $this->syncIrsStatus($request->email);

        return response()->json([
            'success' => 'IRS Disetujui',
            'redirect' => route('perwalian') // Redirect ke halaman perwalian
        ]);
    }

    public function rejectIrs(Request $request)
    {
        $mahasiswa = Mahasiswa::where('email', $request->email)->first();

        // Update status IRS di tabel mahasiswa
        $mahasiswa->status_irs = 'Ditolak';
        $mahasiswa->save();

        // Update status IRS di tabel irs_test untuk mahasiswa tersebut
        Irstest::where('email', $request->email)
            ->update(['status' => 'Ditolak']);

        $this->syncIrsStatus($request->email);

        return response()->json([
            'success' => 'IRS Ditolak',
            'redirect' => route('perwalian') // Redirect ke halaman perwalian
        ]);
    }

    public function getPerwalianData()
    {
        $emailDosen = auth()->user()->email; // Ambil email dosen yang sedang login
    
        $mahasiswa = DB::table('mahasiswa as mhs')
            ->leftJoin('irs_test as irs', 'irs.email', '=', 'mhs.email') // Left join dengan IRS untuk melihat statusnya
            ->join('dosen as dos', 'mhs.nip_doswal', '=', 'dos.nip') // Join dengan dosen berdasarkan nip_doswal
            ->leftJoin('mata_kuliah as mk', 'irs.kodemk', '=', 'mk.kodemk') // Left join dengan mata kuliah untuk menghitung SKS
            ->select(
                'mhs.nim',
                'mhs.nama',
                'mhs.status', // Status dari tabel mahasiswa
                'mhs.ipk',    // IPK dari tabel mahasiswa
                DB::raw("
                    CASE 
                        WHEN irs.status = 'Ditolak' THEN 'Ditolak'
                        WHEN irs.status = 'Disetujui' THEN 'Disetujui'
                        WHEN irs.status = 'Pending' THEN 'Pending'
                        ELSE '' -- Jika belum ngajuin IRS, statusnya kosong
                    END as status_irs
                "),
                DB::raw('SUM(mk.sks) as total_sks') // Hitung total SKS yang diambil oleh mahasiswa
            )
            ->where('dos.email', $emailDosen) // Filter berdasarkan dosen yang sedang login
            ->groupBy('mhs.nim', 'mhs.nama', 'mhs.status', 'mhs.ipk', 'irs.status') // Group by untuk memastikan data mahasiswa unik
            ->orderBy('mhs.nama', 'asc')
            ->get();
    
        return view('paPerwalian', compact('mahasiswa'));
    }

    // public function syncIrsStatus($email)
    // {
    //     // Hitung semua status dari irs_test
    //     $statuses = Irstest::where('email', $email)
    //         ->select('status')
    //         ->get()
    //         ->pluck('status')
    //         ->unique();

    //     $finalStatus = 'Pending'; // Default status jika tidak ada data

    //     if ($statuses->contains('Ditolak')) {
    //         $finalStatus = 'Ditolak'; // Prioritaskan jika ada yang ditolak
    //     } elseif ($statuses->every(fn($status) => $status === 'Disetujui')) {
    //         $finalStatus = 'Disetujui'; // Semua disetujui
    //     }

    //     // Update tabel mahasiswa
    //     Mahasiswa::where('email', $email)->update(['status_irs' => $finalStatus]);
    // }

    public function showRecap($nim)
    {
        // Ambil data mahasiswa berdasarkan NIM
        $mahasiswa = Mahasiswa::where('nim', $nim)->firstOrFail();

        // Ambil data IRS_Test berdasarkan email mahasiswa dan sambungkan ke jadwal berdasarkan ID
        $matakuliah = DB::table('irs_test')
            ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk') // Ambil nama matkul
            ->join('jadwal', 'irs_test.id', '=', 'jadwal.id') // Sambungkan berdasarkan ID
            ->where('irs_test.email', $mahasiswa->email) // Filter berdasarkan email mahasiswa
            ->select(
                'irs_test.*',
                'mata_kuliah.nama as nama_mk',
                'mata_kuliah.sks as sks',
                'jadwal.kelas',
                'jadwal.ruang',
                'jadwal.jammulai',
                'jadwal.jamselesai',
                'jadwal.hari'
            )
            ->get();

        // Hitung Total SKS
        $total_sks = $matakuliah->sum('sks');

        // Kirim data ke view
        return view('mahasiswa.view', compact('mahasiswa', 'matakuliah', 'total_sks'));
    }



}
