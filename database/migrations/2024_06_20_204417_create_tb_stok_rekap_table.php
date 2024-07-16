<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTbStokRekapTable extends Migration
{
    public function up()
    {
        Schema::create('tbStokRekap', function (Blueprint $table) {
            $table->id();
            $table->string('kode');
            $table->unsignedBigInteger('id_barang');
            $table->integer('jumlah');
            $table->timestamp('tanggal');
            $table->foreign('id_barang')->references('id')->on('tbstok')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tbStokRekap');
    }
}

