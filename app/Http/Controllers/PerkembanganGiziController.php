<?php

namespace App\Http\Controllers;

use App\Models\PerkembanganGizi;
use App\Models\Child;
use Illuminate\Http\Request;

class PerkembanganGiziController extends Controller
{
    /**
     * Menampilkan halaman untuk pembaruan perkembangan gizi.
     */
    public function index()
    {
        // Mengambil semua data anak
        $children = Child::all();
        return inertia('Petugas/PerkembanganGizi', ['children' => $children]);
    }

    /**
     * Menyimpan data perkembangan gizi yang diperbarui.
     */
    public function store(Request $request)
    {
        // Validasi data yang diterima dari form
        $request->validate([
            'anak_id' => 'required|exists:children,id',  // Pastikan anak_id ada dalam tabel children
            'berat_badan' => 'required|numeric', // Berat badan dalam angka
            'tinggi_badan' => 'required|numeric', // Tinggi badan dalam angka
            'status_gizi' => 'required|string', // Status gizi anak
            'catatan' => 'nullable|string', // Catatan perkembangan gizi
            'tanggal_pemeriksaan' => 'required|date', // Tanggal pemeriksaan
        ]);

        // Menyimpan data perkembangan gizi ke dalam tabel
        PerkembanganGizi::create([
            'anak_id' => $request->anak_id,
            'berat_badan' => $request->berat_badan,
            'tinggi_badan' => $request->tinggi_badan,
            'status_gizi' => $request->status_gizi,
            'catatan' => $request->catatan,
            'tanggal_pemeriksaan' => $request->tanggal_pemeriksaan,  // Menyimpan tanggal pemeriksaan
        ]);

        // Redirect ke halaman perkembangan gizi setelah data berhasil disimpan
        return redirect()->route('perkembangangizi.index');
    }
}