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
        Schema::create('tbcheckoutdetail', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->string('status')->default('pending');
            $table->unsignedBigInteger('id_user');
            $table->unsignedBigInteger('id_pesanan');
            $table->unsignedBigInteger('id_barang');
            $table->integer('quantity');
            $table->decimal('price', 10, 2);
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
        Schema::dropIfExists('tbcheckoutdetail');
    }
};
