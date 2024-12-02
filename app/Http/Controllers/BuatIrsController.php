<?php

namespace App\Http\Controllers;

use App\Models\Dosen;
use App\Models\Ruang;
use App\Models\Jadwal;
use App\Models\Irstest;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Khs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BuatIrsController extends Controller
{
    public function index()
    {
        
        $user = auth()->user();
        $email = $user->email;
        $mhs = Mahasiswa::where('email', $email)->first();
        $data = Jadwal::select('kodemk')->where('prodi', $user->prodi)->groupBy('kodemk')->get();
        
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

        $day = [
            "" => '',
            1 => 'Senin',
            2 => 'Selasa',
            3 => 'Rabu',
            4 => 'Kamis',
            5 => 'Jumat',
        ];
        
        foreach($data as $d){
            $d->matakuliah = Matakuliah::where('kodemk', $d->kodemk)->first()->nama;
            $d->sks = Matakuliah::where('kodemk', $d->kodemk)->first()->sks;
            $d->kelas = Jadwal::where('kodemk', $d->kodemk)->get();
            $d->semester = Matakuliah::where('kodemk', $d->kodemk)->first()->plotsemester;
            foreach($d->kelas as $k){
                $k->isselected = Irstest::where('email', $email)->where('kodejadwal', $k->id)->where('kodemk', $d->kodemk)->first() ? true : false;
                $k->hari = $day[$k->hari];
                $k->jam = $jamstart[$k->jammulai] . ' - ' . $jamend[$k->jamselesai]; 
            }

        }

        //Menghitung Total SKS
        $picked = Irstest::where('email', $email)->get();
        $total = 0;
        foreach($picked as $p){
            $total += Matakuliah::where('kodemk', $p->kodemk)->first()->sks;
        }


        $dataruang = Ruang::where('status', 'Disetujui')->where('prodi', 'Informatika')->get();

        if($mhs->akses_irs=='yes'){
            return view('mhsBuatIrs', compact('data','email','total'));
        }else{
            $aksesirs = $mhs->akses_irs;
            return view('irsTutup',compact('aksesirs','email'));
        }
    }

    public function index2()
    {

        $email = auth()->user()->email;
        $dosen = Dosen::where('email', $email)->first();

        // LIST PENDING IRS MAHASISWA
        $data = Irstest::select('irs_test.email', 'mahasiswa.nim', 'mahasiswa.nama', DB::raw('SUM(mata_kuliah.sks) as total_sks'))
        ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk') 
        ->join('mahasiswa', 'irs_test.email', '=', 'mahasiswa.email')    
        ->where('irs_test.status', 'Pending')
        ->where('mahasiswa.nip_doswal', $dosen->nip)                    
        ->groupBy('irs_test.email', 'mahasiswa.nim', 'mahasiswa.nama')    
        ->get();

        // Loop untuk cek irs pending mahasiswa
        foreach ($data as $irstest) {
            $irstest->all_pending = !Irstest::where('email', $irstest->email)
                ->where('status', '!=', 'Pending')
                ->exists(); 

            $irstest->datairs = Irstest::where('email', $irstest->email)->where('status','Pending')->get();

            foreach($irstest->datairs as $d){
                $d->matakuliah = Matakuliah::where('kodemk', $d->kodemk)->first()->nama;
                $d->sks = Matakuliah::where('kodemk', $d->kodemk)->first()->sks;
                $d->kelas = Jadwal::where('id', $d->kodejadwal)->first()->kelas;
            }
        }

        return view('paAjuanIrs', compact('data'));
    }

    public function index3() {

        $email = auth()->user()->email;
        $dosen = Dosen::where('email', $email)->first();

        $data = Irstest::select('irs_test.email', 'mahasiswa.nim', 'mahasiswa.nama', DB::raw('SUM(mata_kuliah.sks) as total_sks'))
        ->join('mata_kuliah', 'irs_test.kodemk', '=', 'mata_kuliah.kodemk') 
        ->join('mahasiswa', 'irs_test.email', '=', 'mahasiswa.email')     
        ->where('mahasiswa.akses_irs', 'req')
        ->where('mahasiswa.nip_doswal', $dosen->nip)     
        ->groupBy('irs_test.email', 'mahasiswa.nim', 'mahasiswa.nama')  
        ->get();
        

        foreach($data as $irstest){


            $irstest->datairs = Irstest::join('mahasiswa', 'irs_test.email', '=', 'mahasiswa.email') -> where('mahasiswa.akses_irs', 'req')->get(); 
            foreach($irstest->datairs as $d){
                $d->matakuliah = Matakuliah::where('kodemk', $d->kodemk)->first()->nama;
                $d->sks = Matakuliah::where('kodemk', $d->kodemk)->first()->sks;
                $d->kelas = Jadwal::where('id', $d->kodejadwal)->first()->kelas;
            }
        }
        return view('paAjuanPerubahanIrs', compact('data'));
    }


    public function createIrs(Request $request) {
        $request -> validate([
            'email' => 'required',
            'kodejadwal' => 'required',
            'kodemk' => 'required'
        ]);

        // Mengambil data mahasiswa
        $Mahasiswa = Mahasiswa::where('email', $request->email)->first();
        $smtMahasiswa = $Mahasiswa->semester_berjalan;

        // Mengambil data mata kuliah
        $smtMatakuliah = Matakuliah::where('kodemk', $request->kodemk)->first()->plotsemester;

        // Menentukan prioritas berdasarkan semester
        if($smtMahasiswa > $smtMatakuliah){
        // Jika semester mahasiswa lebih tinggi daripada semester mata kuliah, prioritas lebih tinggi
        $prioritas = 3;  // Diprioritaskan pertama
        }else if($smtMahasiswa == $smtMatakuliah){
        // Jika semester mahasiswa sama dengan semester mata kuliah, prioritas berikutnya
        $prioritas = 2;  // Diprioritaskan setelah yang lebih tinggi
        }else{
        // Jika semester mahasiswa lebih rendah daripada semester mata kuliah, prioritas terakhir
        $prioritas = 1;  // Diprioritaskan terakhir
}

        $data = [
            'email' => $request->email,
            'kodejadwal' => $request->kodejadwal,
            'kodemk' => $request->kodemk,
            'prioritas' => $prioritas,
            'status' => 'Pending',
            'semester' => $Mahasiswa->semester_berjalan
        ];

        //check email dan kodemk di database
        $check = Irstest::where('email', $data['email'])->where('kodemk', $data['kodemk'])->first();
        if($check) {
            $check->update($data);
        }else{

            Irstest::create($data);
        }

        //pengurutan irs berdasarkan irs prioritas
        $row_index = Irstest::select(DB::raw('ROW_NUMBER() OVER (ORDER BY prioritas DESC,updated_at ASC) AS row_index,email'))
        ->where('kodejadwal', $data['kodejadwal'])
        ->get();

        $jadwal = Jadwal::where('id', $data['kodejadwal'])->first();

        $position = 0;
        foreach($row_index as $r){
            if($r->email == $data['email']){
                $position = $r->row_index;
            }

            if($r->row_index > $jadwal->kapasitas){
                $delete = Irstest::where('email', $r->email)->where('kodejadwal', $data['kodejadwal'])->first();
                $delete->delete();
            }

        }

        //menghitung sks berdasarkan email
        $picked = Irstest::where('email', $data['email'])->get();
        $total = 0;
        foreach($picked as $p){
            $total += Matakuliah::where('kodemk', $p->kodemk)->first()->sks;
        }

        $data['sks'] = $total;
        $data['position'] = $position;
        
        return response()->json(['data' => $data, 'position' => $row_index]);   
        
    }

    public function deleteIrs(Request $request) {

        $request->validate(['id' => 'required']);

        $id = $request->id;
        $data = Irstest::find($id);

        $kodejadwal = $data->kodejadwal;
        $data->delete();

        $user = auth()->user();
        $email = $user->email;
        $picked = Irstest::where('email', $email)->get();
        $total = 0;
        foreach($picked as $p){
            $total += Matakuliah::where('kodemk', $p->kodemk)->first()->sks;
        }
        return response()->json(['kodejadwal' => $kodejadwal,'sks' => $total]);
    }

    public function viewIrs(Request $request) {
        $request->validate(['email' => 'required']);
        
        $data = Irstest::where('email', $request->email)->get();
    
        foreach ($data as $d) {
            $matkul = Matakuliah::where('kodemk', $d->kodemk)->first();
            $d->nama = $matkul ? $matkul->nama : 'N/A';
            $d->sks = $matkul ? $matkul->sks : 0;
            $d->kelas = Jadwal::where('id', $d->kodejadwal)->first();
            $d->kapasitas = $d->kelas->kapasitas;
            $row_index = Irstest::select(DB::raw('ROW_NUMBER() OVER (ORDER BY prioritas DESC, updated_at ASC) AS row_index,email'))
            ->where('kodejadwal', $d->kodejadwal)
            ->get();
            $position = 0;
            foreach($row_index as $r){
                if($r->email == $request->email){
                    $position = $r->row_index;
                }
            }
            $d->position = $position;
        }
        return response()->json($data);
    }

    public function approve(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        // Menyetujui irs mahasiswa yang pending
        Irstest::where('email', $request->email)
            ->where('status', 'Pending')
            ->update(['status' => 'Disetujui']);
        
        Mahasiswa::where('email', $request->email)
        ->update(['akses_irs' => 'no']);

        return response()->json(['message' => 'Jadwal has been approved for ' . $request->email]);
    }

    public function reject(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        // Menolak Irs mahasiswa
        Irstest::where('email', $request->email)
            ->where('status', 'Pending')
            ->update(['status' => 'Ditolak']);

        return response()->json(['message' => 'Jadwal has been rejected for ' . $request->email]);
    }

    public function approvePerubahan(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        // Menyetujui perubahan irs mahasiswa
        Irstest::where('email', $request->email)
            ->where('status', 'Disetujui')
            ->update(['status' => 'Pending']);

        Mahasiswa::where('email', $request->email)
            ->update(['akses_irs' => 'yes']);

        return response()->json(['message' => 'Ajuan perubahan has been approved for ' . $request->email]);
    }

    public function rejectPerubahan(Request $request)
    {
        $request->validate([
            'email' => 'required'
        ]);

        //Menolak perubahan IRS Mahasiswa
        Mahasiswa::where('email', $request->email)
            ->update(['akses_irs' => 'no']);

        return response()->json(['message' => 'Ajuan perubahan has been rejected for ' . $request->email]);
    }


    public function ajuanPerubahan(Request $request)
    {

        //Ajuan perubahan irs mahasiswa ke pembimbing akademik
        $email = $request->email;

        $mhs = Mahasiswa::where('email', $email)->first();
        $mhs->akses_irs = 'req';
        $mhs->save();

        return response()->json(['message' => 'Ajuan perubahan berhasil diajukan', 'mhs' => $mhs]);
        
    }
    
}
