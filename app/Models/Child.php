<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    protected $table = 'children';

    protected $fillable = [
        'nama',
        'nama_ortu',
        'tanggal_lahir',
        'jenis_kelamin',
        'usia',
        'berat_badan',
        'tinggi_badan',
        'lingkar_lengan',
        'lingkar_kepala',
        'desa',
        'status_gizi',
        'latitude',
        'longitude',
    ];

    // Optional: cast tanggal_lahir ke objek date
    protected $casts = [
        'tanggal_lahir' => 'date',
    ];
}