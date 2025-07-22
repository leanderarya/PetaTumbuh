<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Child;
use App\Models\Artikel; // 1. Tambahkan use statement untuk model Artikel
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BerandaController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Inertia\Response
     */
    public function index()
    {
        // Fetch children data (sudah ada)
        $children = Child::all();

    // Menampilkan Jumlah_anak yang berstatus gizi 'Kurang' atau 'Bawah Garis Merah'
    $dusunStats = DB::table('children')
        ->whereIn('status_gizi', ['Kurang', 'Bawah Garis Merah'])
        ->select('desa', DB::raw('count(*) as jumlah_anak'))
        ->groupBy('desa')
        ->get();

        // 2. Tambahkan logika untuk mengambil 3 artikel terbaru
        $latestArtikels = Artikel::latest()->take(3)->get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'description' => substr(strip_tags($artikel->content), 0, 100) . '...',
                'image' => asset('storage/' . $artikel->image),
                'date' => $artikel->date,
            ];
        });

        // 3. Kirim semua data ke komponen React 'Beranda'
        return Inertia::render('Beranda', [
            'children' => $children,
            'dusunStats' => $dusunStats,
            'artikels' => $latestArtikels, // Tambahkan data artikel di sini
        ]);
    }
}