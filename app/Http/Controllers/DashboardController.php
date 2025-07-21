<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Child;
use Illuminate\Support\Facades\DB; // Menggunakan facade lengkap lebih baik

class DashboardController extends Controller
{
    /**
     * Menampilkan halaman dashboard utama.
     */
    public function index()
    {
        // Ambil semua data anak dari database
        $children = Child::all();

        // Statistik: hanya "Kurang" & "Bawah Garis Merah"
        $stats = [
            'total' => $children->count(),
            'avg_usia' => round($children->avg('usia'), 1),
            'stunting' => $children->whereIn('status_gizi', ['Bawah Garis Merah', 'Kurang'])->count(),
        ];

        // Statistik per dusun
        $dusunStats = DB::table('children')
            ->select('desa', DB::raw('count(*) as jumlah_anak'))
            ->groupBy('desa')
            ->get();

        return Inertia::render('dashboard', [
            'anakData' => $children,
            'stats' => $stats,
            'dusunStats' => $dusunStats,
        ]);
    }
}
