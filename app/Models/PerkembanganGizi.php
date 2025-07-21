<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerkembanganGizi extends Model
{
    protected $fillable = [
        'anak_id',
        'berat_badan',
        'tinggi_badan',
        'status_gizi',
        'catatan',
        'tanggal_pemeriksaan',
    ];
}