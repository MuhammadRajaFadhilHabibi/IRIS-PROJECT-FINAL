<?php

namespace App\Http\Controllers;

use App\Models\Ruang;
use Illuminate\Http\Request;

class RuangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Ruang::all();
        return view('baBuatRuang', compact('data'));
    }
    
    public function index2()
    {
        //check if there is a last prodi that was edited return ruang data with the last prodi

        $ruangfree = Ruang::where('prodi', 'free')->get();

        if(session('lastprodi')){
            $data = Ruang::where('prodi', session('lastprodi'))->get();
            $prodi = session('lastprodi');
            return view('baPlotRuang', compact('data', 'prodi', 'ruangfree'));
        }else{
            $data = [];
            $prodi = '';
            return view('baPlotRuang', compact('data', 'prodi', 'ruangfree'));
        }
    }
    
    public function index3()
    {
        $data = Ruang::all();
        return view('dkAjuanRuang', compact('data'));
    }

    public function dashboard()
    {
        $ajuan = Ruang::where('status', 'Pending')->count();
        $disetujui = Ruang::where('status', 'Disetujui')->count();
        $ditolak = Ruang::where('status', 'Ditolak')->count();

        //count ruang and group by prodi
        $ruang = Ruang::select('prodi')->selectRaw('count(*) as total')->groupBy('prodi')->get();


        $data = [
            'ajuan' => $ajuan,
            'disetujui' => $disetujui,
            'ditolak' => $ditolak,
            'dataruang' => $ruang
        ];

        return view('baDashboard', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi Input
        $validated = $request->validate([
            'noruang' => 'required|unique:ruang,noruang', // Validasi unik pada noruang
            'blokgedung' => 'required',
            'lantai' => 'required|integer',
            'fungsi' => 'required',
            'kapasitas' => 'required|integer',
            'prodi' => 'required|in:Informatika,Fisika,Matematika,Statistika,Biologi', // Validasi Prodi
        ]);
    
        try {
            // Simpan Data ke Database
            $ruang = Ruang::create([
                'noruang' => $validated['noruang'],
                'blokgedung' => $validated['blokgedung'],
                'lantai' => $validated['lantai'],
                'fungsi' => $validated['fungsi'],
                'kapasitas' => $validated['kapasitas'],
                'status' => 'Pending', // Default status
                'prodi' => $validated['prodi'], // Simpan Prodi ke kolom 'prodi'
            ]);
    
            // Jika berhasil, kembalikan respons JSON
            return response()->json([
                'success' => true,
                'message' => 'Ruang berhasil ditambahkan.',
                'data' => $ruang->only(['id', 'noruang', 'blokgedung', 'lantai', 'fungsi', 'kapasitas', 'prodi', 'status']),
            ]);
            
            
    
        } catch (\Exception $e) {
            // Tangani Error
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menyimpan data.',
            ], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $request -> validate([
            'noruang' => 'required',
            'blokgedung' => 'required',
            'lantai' => 'required',
            'fungsi' => 'required',
            'kapasitas' => 'required',
            'prodi' => 'required|string|max:255', // Pastikan ini ada
        ]);

        $data = [
            'noruang' => $request->noruang,
            'blokgedung' => $request->blokgedung,
            'lantai' => $request->lantai,
            'fungsi' => $request->fungsi,
            'kapasitas' => $request->kapasitas,
            'prodi' => $request->prodi, // Pastikan prodi diperbarui
            'status' => 'Pending',
        ];

        Ruang::find($id)->update($data);
        return redirect()->route('ruang');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Ruang::find($id)->delete();
        return response()->json([
            'success' => true,
            'message' => 'Ruang berhasil dihapus'
        ]);
    }

    public function plotProdi(Request $request)
    {
        $prodi = $request->input('prodi');

        // Fetch data based on the selected program and status = disetujui
        $data = Ruang::where('prodi', $prodi)->where('status', 'Disetujui')->get();

        return response()->json(['data' => $data]);
    }

    public function editProdi(Request $request){


        $request -> validate([
            'id' => 'required',
            'prodi' => 'required',
        ]);

        $ruang = Ruang::find($request->id);

        $ruang->prodi = 'free';
        $ruang->save();

        $data = Ruang::where('prodi', $request->prodi)->get();

        $noruang = $ruang->noruang;

        return response()->json(['message' => 'Ruang has been plotted successfully.', 'data' => $data, 'noruang' => $noruang]);
    
    }

    public function updateStatus(Request $request, $id)
    {   
        if ($id == 'all') {
            $ruang = Ruang::where('status', 'Pending')->get();
            foreach ($ruang as $r) {
                $r->status = $request->status;
                $r->save();
            }
        }
        else {
            $ruang = Ruang::findOrFail($id);
            $ruang->status = $request->status;
            $ruang->save();
        }

        return response()->json(['message' => 'Status updated successfully.', 'data' => $ruang]);
    }


    public function plotRuang(Request $request)
    {
        $request -> validate([
            'id' => 'required',
            'prodi' => 'required',
        ]);

        $ruang = Ruang::find($request->id);

        $ruang->prodi = $request->prodi;
        $ruang->save();

        $data = Ruang::where('prodi', $request->prodi)->get();

        return response()->json(['message' => 'Ruang has been plotted successfully.', 'data' => $data]);
    }

    
    
}