<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BookingFacility extends Model
{
    use HasFactory;
    protected $fillable = [
        'tgl_transaksi',
        'nama_customer',
        'alamat_customer',
        'id_facility',
        'nama_kasir',
        'harga_kelola',
        'harga_sewa',
        'lama_sewa',
        'total_sewa',
    ];

    public function facility(){
        return $this->belongsTo(Facility::class, "id_facility");
    }
}
