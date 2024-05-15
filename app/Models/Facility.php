<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_fasilitas',
        'alamat',
        'pj_fasilitas',
        'harga_kelola',
        'harga_sewa',
    ];
}
