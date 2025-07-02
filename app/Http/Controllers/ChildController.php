<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Inertia\Inertia;
use Illuminate\Http\Request;

class ChildController extends Controller
{
    public function index()
    {
        $children = Child::all();
        return Inertia::render('Children/DaftarAnak', ['children' => $children]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'usia' => 'required|integer',
            'berat_badan' => 'required|numeric',
            'tinggi_badan' => 'required|numeric',
            'desa' => 'required',
            'status_gizi' => 'required',
            'latitude' => 'nullable|numeric',
            'longitude' => 'nullable|numeric',
        ]);

        Child::create($request->all());
        return redirect()->route('children.index');
    }
}
