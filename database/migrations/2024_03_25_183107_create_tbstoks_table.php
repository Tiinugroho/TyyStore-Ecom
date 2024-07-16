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
        Schema::create('tbstok', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('nama_barang');
            $table->string('saldoawal');
            $table->string('hargabeliakhir');
            $table->string('hargajual');
            $table->string('tglmasuk');
            $table->string('hargamodal');
            $table->string('foto');
            $table->string('desc');
            $table->string('pajang');
            $table->string('saldoakhir');
            $table->foreignId('id_satuan')->index()->constrained('tbsatuan');
            $table->foreignId('id_kategori')->index()->constrained('tbkategori');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbstok');
    }
};
