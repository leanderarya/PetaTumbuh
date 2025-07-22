<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Ebook;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // 1. Tambahkan ini

class EbookController extends Controller
{
    public function index()
    {
        $ebooks = Ebook::latest()->get()->map(function ($ebook) {
            return [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                // 2. UBAH CARA MENGAMBIL URL
                'image' => $ebook->cover_path ? Storage::disk('public_uploads')->url($ebook->cover_path) : null,
                'file' => $ebook->file_path ? Storage::disk('public_uploads')->url($ebook->file_path) : null,
                'is_new' => $ebook->is_new,
            ];
        });

        return Inertia::render('Ebook', ['ebooks' => $ebooks]);
    }

    public function petugasIndex()
    {
        $ebooks = Ebook::latest()->get()->map(function ($ebook) {
            return [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                // 2. UBAH CARA MENGAMBIL URL
                'image' => $ebook->cover_path ? Storage::disk('public_uploads')->url($ebook->cover_path) : null,
                'file' => $ebook->file_path ? Storage::disk('public_uploads')->url($ebook->file_path) : null,
                'is_new' => $ebook->is_new,
            ];
        });

        return Inertia::render('Petugas/FormEbook', ['ebooks' => $ebooks]);
    }

    public function edit($id)
    {
        $ebook = Ebook::findOrFail($id);
        return Inertia::render('Petugas/FormEbook', [
            'editingEbook' => [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                'is_new' => $ebook->is_new,
                // 2. UBAH CARA MENGAMBIL URL
                'cover_preview' => $ebook->cover_path ? Storage::disk('public_uploads')->url($ebook->cover_path) : null,
            ]
        ]);
    }

    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255|unique:ebooks,title,' . $id,
            'description' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:50120',
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:5048',
            'is_new' => 'boolean',
        ]);

        // 3. PERBAIKAN LOGIKA & PENGGUNAAN DISK
        if ($request->hasFile('file')) {
            // Hapus file PDF lama jika ada
            if ($ebook->file_path) {
                Storage::disk('public_uploads')->delete($ebook->file_path);
            }
            // Simpan yang baru dan update path
            $ebook->file_path = $request->file('file')->store('ebooks', 'public_uploads');
        }

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($ebook->cover_path) {
                Storage::disk('public_uploads')->delete($ebook->cover_path);
            }
            // Simpan yang baru dan update path
            $ebook->cover_path = $request->file('cover')->store('covers', 'public_uploads');
        }

        // Update data lainnya
        $ebook->title = $request->title;
        $ebook->description = $request->description;
        $ebook->is_new = $request->is_new;
        $ebook->save(); // Simpan semua perubahan

        return redirect()->route('ebooks.petugasIndex')->with('success', 'E-Book berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);
        // 3. UBAH DISK UNTUK MENGHAPUS
        Storage::disk('public_uploads')->delete([$ebook->file_path, $ebook->cover_path]);
        $ebook->delete();
        return back()->with('success', 'E-Book berhasil dihapus.');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:ebooks,title',
            'description' => 'required|string',
            'file' => 'required|mimes:pdf|max:50120',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'is_new' => 'boolean',
        ]);

        // 3. UBAH DISK UNTUK MENYIMPAN
        $filePath = $request->file('file')->store('ebooks', 'public_uploads');
        $coverPath = $request->file('cover')->store('covers', 'public_uploads');

        Ebook::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath,
            'cover_path' => $coverPath,
            'is_new' => $request->is_new,
        ]);

        return redirect()->route('ebooks.petugasIndex')->with('success', 'E-Book berhasil diunggah!');
    }
}