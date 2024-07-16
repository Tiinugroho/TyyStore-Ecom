<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveForeignKeyTbreturnbeli extends Migration
{
    public function up()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            // Hapus foreign key id_stok_rekap dari tbreturnbeli
            $table->dropForeign(['id_stok_rekap']);
            // Hapus kolom id_stok_rekap dari tbreturnbeli
            $table->dropColumn('id_stok_rekap');
        });
    }

    public function down()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            // Tambahkan kembali kolom id_stok_rekap ke tbreturnbeli
            $table->unsignedBigInteger('id_stok_rekap');
            // Tambahkan foreign key id_stok_rekap yang mengacu pada tbstokrekap
            $table->foreign('id_stok_rekap')->references('id')->on('tbstokrekap');
        });
    }
}

