<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;

class AjuanIRSController extends Controller
{
    public function updateStatus(Request $request, $id)
    {
        // Cari mahasiswa berdasarkan ID
        $mahasiswa = Mahasiswa::findOrFail($id);

        // Update status_irs sesuai input dari tombol
        $mahasiswa->status_irs = $request->input('status');
        $mahasiswa->save();

        // Redirect ke halaman sebelumnya dengan pesan sukses
        return redirect()->back()->with('success', 'Status IRS berhasil diperbarui!');
    }
}
