<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Carbon\Carbon; // Import Carbon untuk kalkulasi tanggal
use Illuminate\Http\Request;
use Inertia\Inertia;

class ChildController extends Controller
{
    /**
     * Menampilkan halaman dashboard dengan data anak.
     */
    public function dashboard()
    {
        $children = Child::all();
        return Inertia::render('dashboard', [
            'anakData' => $children,
        ]);
    }

    /**
     * Menampilkan halaman daftar anak (manajemen data).
     */
    public function index()
    {
        $children = Child::latest()->get();
        return Inertia::render('Petugas/DaftarAnak', [
            'children' => $children,
        ]);
    }

    /**
     * Menampilkan form untuk menambah data anak baru.
     */
    public function create()
    {
        return Inertia::render('Petugas/DaftarAnakCreate'); // Sesuaikan dengan nama file Anda
    }

    /**
     * Menyimpan data anak baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nama' => 'required|string|max:100',
            'nama_ortu' => 'nullable|string|max:100',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|in:L,P',
            'desa' => 'required|string|max:50',
            'berat_badan' => 'required|numeric|min:1|max:50',
            'tinggi_badan' => 'required|numeric|min:30|max:150',
            'lingkar_lengan' => 'nullable|numeric|min:5|max:30',
            'lingkar_kepala' => 'nullable|numeric|min:20|max:60',
            'status_gizi' => 'required|string|max:50',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
        ]);

        // Hitung usia dalam bulan secara otomatis
        $validatedData['usia'] = Carbon::parse($validatedData['tanggal_lahir'])->diffInMonths(now());

        Child::create($validatedData);

        return redirect()->back()->with('success', 'Data berhasil ditambahkan!');
    }

    /**
     * Memperbarui data anak yang sudah ada.
     * Menggunakan Route Model Binding (Child $child)
     */
    public function update(Request $request, $id)
    {
        $child = Child::findOrFail($id);

        $data = $request->validate([
            'nama' => 'required|string|max:255',
            'nama_ortu' => 'nullable|string|max:255',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string|max:10',
            'desa' => 'required|string|max:255',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'lingkar_lengan' => 'nullable|numeric',
            'lingkar_kepala' => 'nullable|numeric',
            'status_gizi' => 'required|string',
            'latitude' => 'nullable|string',
            'longitude' => 'nullable|string',
        ]);

        $child->update($data);

        return redirect()->back()->with('success', 'Data berhasil diperbarui!');
    }

    /**
     * Menghapus data anak.
     * Menggunakan Route Model Binding (Child $child)
     */
    public function destroy(Child $child)
    {
        $child->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
