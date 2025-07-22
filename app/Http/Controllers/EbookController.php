<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Ebook;
use Illuminate\Http\Request;

class EbookController extends Controller
{
    // Menampilkan daftar E-Book untuk pengguna
    public function index()
    {
        $ebooks = Ebook::all()->map(function ($ebook) {
            return [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                'image' => asset('storage/' . $ebook->cover_path),  // Menyesuaikan cover
                'file' => asset('storage/' . $ebook->file_path),     // Menyesuaikan file
                'is_new' => $ebook->is_new,
            ];
        });

        return Inertia::render('Ebook', ['ebooks' => $ebooks]);
    }

    // Menampilkan daftar E-Book untuk admin (petugas)
    public function petugasIndex()
    {
        $ebooks = Ebook::all()->map(function ($ebook) {
            return [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                'image' => asset('storage/' . $ebook->cover_path),
                'file' => asset('storage/' . $ebook->file_path),
                'is_new' => $ebook->is_new,
            ];
        });

        return Inertia::render('Petugas/FormEbook', ['ebooks' => $ebooks]);
    }

    // Menampilkan halaman untuk mengedit E-Book
    public function edit($id)
    {
        $ebook = Ebook::findOrFail($id);

        return Inertia::render('Petugas/FormEbook', [
            'editingEbook' => [
                'id' => $ebook->id,
                'title' => $ebook->title,
                'description' => $ebook->description,
                'is_new' => $ebook->is_new,
                'cover_preview' => asset('storage/' . $ebook->cover_path),
            ]
        ]);
    }

    // Mengupdate E-Book
    public function update(Request $request, $id)
    {
        $ebook = Ebook::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255|unique:ebooks,title,' . $id,
            'description' => 'required|string',
            'file' => 'nullable|mimes:pdf|max:50120', // Keep the same for file
            'cover' => 'nullable|image|mimes:jpg,jpeg,png|max:5048', // Set the max size to 20MB (20480 KB)
            'is_new' => 'boolean',
        ]);

        // Update file jika ada
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('ebooks', 'public');
            $ebook->file_path = $filePath;
        }

        // Update cover jika ada
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
            $ebook->cover_path = $coverPath;
        }

        $ebook->update([
            'title' => $request->title,
            'description' => $request->description,
            'is_new' => $request->is_new,
        ]);

        return redirect()->route('ebooks.petugasIndex')->with('success', 'E-Book berhasil diperbarui!');
    }

    // Menghapus E-Book
    public function destroy($id)
    {
        $ebook = Ebook::findOrFail($id);

        // Hapus file dari storage
        \Storage::disk('public')->delete([$ebook->file_path, $ebook->cover_path]);

        $ebook->delete();

        return back()->with('success', 'E-Book berhasil dihapus.');
    }

    // Menyimpan E-Book baru
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255|unique:ebooks,title',
            'description' => 'required|string',
            'file' => 'required|mimes:pdf|max:50120',
            'cover' => 'required|image|mimes:jpg,jpeg,png|max:5048',
            'is_new' => 'boolean',
        ]);

        $filePath = $request->file('file')->store('ebooks', 'public');
        $coverPath = $request->file('cover')->store('covers', 'public');

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