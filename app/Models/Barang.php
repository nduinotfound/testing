<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // Pastikan SoftDeletes ada di model


class Barang extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nama_barang',
        'kode_barang',
        'kategori',
        'jumlah',
        'kondisi',
        'lokasi_simpan',
        'tanggal_masuk',
    ];
}
