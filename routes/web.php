<?php

use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\BerandaController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\ChildController;
use App\Http\Controllers\PerkembanganGiziController;
use App\Http\Controllers\EbookController;
use App\Http\Controllers\DashboardController;

Route::get('/', [BerandaController::class, 'index'])->name('home');
Route::get('/ebook', [EbookController::class, 'index'])->name('ebook');
Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel.index');
Route::get('/artikel/{artikel}', [ArtikelController::class, 'show'])->name('artikel.show');



// Bagian Petugas Kesehatan

// Gunakan ->prefix('tambuh') untuk menerapkan prefix ke semua route di dalam grup
// Hapus '/tambuh' dari setiap route individual untuk menghindari duplikasi (contoh: /tambuh/tambuh/artikel)
Route::middleware(['auth', 'verified'])->prefix('tambuh')->group(function () {
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Route Artikel
    Route::get('artikel/create', [ArtikelController::class, 'create'])->name('artikel.create');
    Route::post('artikel', [ArtikelController::class, 'store'])->name('artikel.store');
    Route::post('artikel/{artikel}', [ArtikelController::class, 'update'])->name('artikel.update');
    Route::delete('artikel/{artikel}', [ArtikelController::class, 'destroy'])->name('artikel.destroy');

    // Route E-Book
    Route::get('upload-ebook', [EbookController::class, 'petugasIndex'])->name('ebooks.petugasIndex');
    Route::post('upload-ebook', [EbookController::class, 'store'])->name('ebooks.store');
    Route::get('ebooks/{id}/edit', [EbookController::class, 'edit'])->name('ebooks.edit');
    Route::put('ebooks/{id}', [EbookController::class, 'update'])->name('ebooks.update');
    Route::delete('ebooks/{id}', [EbookController::class, 'destroy'])->name('ebooks.destroy');

    // Route Daftar Anak
    Route::get('daftaranak', [ChildController::class, 'index'])->name('children.index');
    Route::post('daftaranak', [ChildController::class, 'store'])->name('children.store');
    Route::put('daftaranak/{id}', [ChildController::class, 'update'])->name('children.update');
    Route::delete('daftaranak/{id}', [ChildController::class, 'destroy'])->name('children.destroy');
    
    // Route::get('perkembangan-gizi', [PerkembanganGiziController::class, 'index'])->name('perkembangangizi.index');
    // Route::post('perkembangan-gizi', [PerkembanganGiziController::class, 'store'])->name('perkembangangizi.store');
});

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
