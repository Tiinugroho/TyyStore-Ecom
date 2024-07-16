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
        Schema::create('tbpesanans', function (Blueprint $table) {
            $table->id();
            $table->string('kode_pesanan')->nullable(false);
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah_pesan');
            $table->dateTime('tanggal');
            $table->decimal('jumlah_harga', 10, 2);
            $table->tinyInteger('status');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('tbstok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbpesanans');
    }
};
