<?php

namespace App\Http\Controllers;

use App\Models\Child;
use Inertia\Inertia;
use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function index()
    {
        // Fetch children data
        $children = Child::all();

        // Pass the data to Petugas/DaftarAnak component
        return Inertia::render('dashboard', [
            'children' => $children, // Data for Petugas/DaftarAnak component
        ]);
    }
}
