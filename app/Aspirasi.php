<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    use HasFactory;

    protected $table = 'aspirasi_db';

    protected $fillable = [
        'nama',
        'prodi',
        'kontak',
        'jenis_aspirasi',
        'aspirasi',
        'waktu_kejadian',
        'bukti_files',
        'submitted_at',
    ];

    // Konversi tipe data otomatis
    protected $casts = [
        'waktu_kejadian' => 'date',
        'submitted_at'   => 'date',
        'bukti_files'    => 'array',
    ];
}
