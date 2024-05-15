<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('booking_facilities', function (Blueprint $table) {
            $table->id();
            $table->date('tgl_transaksi');
            $table->string('nama_customer');
            $table->string('alamat_customer');
            $table->integer('id_facility');
            $table->string('nama_kasir');
            $table->integer('harga_kelola');
            $table->integer('harga_sewa');
            $table->integer('lama_sewa');
            $table->integer('total_sewa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('booking_facilities');
    }
};
