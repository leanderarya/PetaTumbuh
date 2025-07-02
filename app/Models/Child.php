<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Child extends Model
{
    //
        protected $fillable = [
        'nama',
        'usia',
        'berat_badan',
        'tinggi_badan',
        'desa',
        'status_gizi',
        'latitude',
        'longitude',
    ];
}
