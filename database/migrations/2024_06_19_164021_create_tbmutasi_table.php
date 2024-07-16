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
            $table->string('desc');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
            $table->integer('saldo_sebelum');
            $table->integer('saldo_setelah');
            $table->date('tanggal');
            $table->string('status')->enum('masuk','keluar','return');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_barang');
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('id_pesanan')->references('id')->on('tbpesanans')->onDelete('cascade');
            $table->foreign('id_barang')->references('id')->on('tbstok')->onDelete('cascade');
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
