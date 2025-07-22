<?php

namespace App\Http\Controllers;

use App\Models\Artikel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ArtikelController extends Controller
{
    // Method untuk menampilkan semua artikel
    public function index()
    {
        $artikels = Artikel::latest()->get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'description' => substr(strip_tags($artikel->content), 0, 150) . '...',
                'image' => $artikel->image ? Storage::disk('public_uploads')->url($artikel->image) : null,
                'date' => $artikel->date,
                'is_new' => $artikel->is_new,
            ];
        });

        return Inertia::render('Artikel/Index', [
            'artikels' => $artikels,
        ]);
    }

    // Method untuk menampilkan detail satu artikel
    public function show(Artikel $artikel)
    {
        $otherArticles = Artikel::where('id', '!=', $artikel->id)
                                  ->inRandomOrder()
                                  ->limit(3)
                                  ->get(['id', 'title', 'image'])
                                  ->map(function ($item) {
                                      $item->image = $item->image ? Storage::disk('public_uploads')->url($item->image) : null;
                                      return $item;
                                  });

        return Inertia::render('Artikel/Show', [
            'artikel' => [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'author' => $artikel->author,
                'image' => $artikel->image ? Storage::disk('public_uploads')->url($artikel->image) : null,
                'content' => $artikel->content,
                'date' => $artikel->date,
            ],
            'otherArticles' => $otherArticles
        ]);
    }

    // Method untuk menampilkan halaman admin/create
    public function create()
    {
        $artikels = Artikel::latest()->get()->map(function ($artikel) {
            return [
                'id' => $artikel->id,
                'title' => $artikel->title,
                'description' => substr(strip_tags($artikel->content), 0, 100) . '...',
                'image' => $artikel->image ? Storage::disk('public_uploads')->url($artikel->image) : null,
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

    // Method untuk menyimpan artikel baru
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
            $imagePath = $request->file('image')->store('artikels', 'public_uploads');
            $validatedData['image'] = $imagePath;
        }

        Artikel::create($validatedData);

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil ditambahkan!');
    }

    // Method untuk memperbarui artikel
    public function update(Request $request, Artikel $artikel)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:100',
            'date' => 'required|date',
            'content' => 'required|string',
            'is_new' => 'boolean',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5048',
        ]);

        if ($request->hasFile('image')) {
            if ($artikel->image) {
                Storage::disk('public_uploads')->delete($artikel->image);
            }
            $imagePath = $request->file('image')->store('artikels', 'public_uploads');
            $validatedData['image'] = $imagePath;
        } else {
            unset($validatedData['image']);
        }

        $artikel->update($validatedData);

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil diperbarui!');
    }

    // Method untuk menghapus artikel
    public function destroy(Artikel $artikel)
    {
        if ($artikel->image) {
            Storage::disk('public_uploads')->delete($artikel->image);
        }

        $artikel->delete();

        return redirect()->route('artikel.create')->with('message', 'Artikel berhasil dihapus!');
    }
}