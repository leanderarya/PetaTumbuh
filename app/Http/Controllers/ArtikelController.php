<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    // ... (method index, show, create tidak perlu diubah)
    public function index()
    {
        $artikels = Artikel::latest()->get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'description' => substr(strip_tags($artikel->content), 0, 150) . '...',
                'image' => asset('storage/' . $artikel->image),
                'date' => $artikel->date,
                'is_new' => $artikel->is_new,
            ];
        });

        return Inertia::render('Artikel/Index', [
            'artikels' => $artikels,
        ]);
    }

    public function show(Artikel $artikel)
    {
        $otherArticles = Artikel::where('id', '!=', $artikel->id)
                                  ->inRandomOrder()
                                  ->limit(3)
                                  ->get(['id', 'title', 'image'])
                                  ->map(function ($item) {
                                      $item->image = asset('storage/' . $item->image);
                                      return $item;
                                  });

        return Inertia::render('Artikel/Show', [
            'artikel' => [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'author' => $artikel->author,
                'image' => asset('storage/' . $artikel->image),
                'content' => $artikel->content,
                'date' => $artikel->date,
            ],
            'otherArticles' => $otherArticles
        ]);
    }

    public function create()
    {
        $artikels = Artikel::latest()->get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'description' => substr(strip_tags($artikel->content), 0, 100) . '...',
                'image' => asset('storage/' . $artikel->image),
                'author' => $artikel->author,
                'date' => $artikel->date,
                'content' => $artikel->content,
                'is_new' => $artikel->is_new,
            ];
        });

        return Inertia::render('Petugas/Create', [
            'artikels' => $artikels,
        ]);
    }


    /**
     * Menyimpan artikel baru ke database.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'date' => 'required|date',
            'content' => 'required|string',
            'is_new' => 'boolean',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->hasFile('image')) {
            // PERBAIKAN: Simpan path lengkap (folder + nama file)
            $imagePath = $request->file('image')->store('artikels', 'public');
            $validatedData['image'] = $imagePath; // Hapus basename()
        }

        Artikel::create($validatedData);

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil ditambahkan!');
    }

    /**
     * Memperbarui data artikel yang sudah ada di database.
     */
    // app/Http/Controllers/ArtikelController.php

    public function update(Request $request, Artikel $artikel)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'date' => 'required|date',
            'content' => 'required|string',
            'is_new' => 'boolean',
            // Gambar tidak wajib saat update
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        // Cek jika ada file gambar baru yang di-upload
        if ($request->hasFile('image')) {
            // Hapus gambar lama dari storage
            if ($artikel->image) {
                Storage::disk('public')->delete($artikel->image);
            }

            // Simpan gambar baru dan update nama filenya
            $imagePath = $request->file('image')->store('artikels', 'public');
            $validatedData['image'] = $imagePath;
        } else {
            // **INI BAGIAN PENTINGNYA**
            // Jika tidak ada gambar baru, hapus 'image' dari data yang akan di-update
            // agar nilai lama di database tidak ditimpa dengan null.
            unset($validatedData['image']);
        }

        // Update data artikel di database
        $artikel->update($validatedData);

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil diperbarui!');
    }

    /**
     * Menghapus artikel dari database.
     */
    public function destroy(Artikel $artikel)
    {
        if ($artikel->image) {
            Storage::disk('public')->delete($artikel->image); // Hapus path lengkap
        }

        $artikel->delete();

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil dihapus!');
    }
}