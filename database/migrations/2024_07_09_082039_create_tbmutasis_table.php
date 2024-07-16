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
        Schema::create('tbmutasi', function (Blueprint $table) {
            $table->id();
            $table->string('no_bukti');
            $table->string('mk');
            $table->string('barang');
            $table->integer('qty');
            $table->string('harga');
            $table->string('tanggal_pembelian');
            $table->string('tanggal_approve');
            $table->string('status');
            $table->string('bukti_pembayaran');
            $table->string('user_id');
            $table->text('ket');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbmutasi');
    }
};
