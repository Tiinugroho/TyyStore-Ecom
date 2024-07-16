<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyTbreturnbeliTbmasuk extends Migration
{
    public function up()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            // Tambahkan foreign key id_masuk yang mengacu pada tbmasuk
            $table->unsignedBigInteger('id_masuk')->nullable();
            $table->foreign('id_masuk')->references('id')->on('tbmasuk')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            // Hapus foreign key id_masuk dari tbreturnbeli
            $table->dropForeign(['id_masuk']);
            // Hapus kolom id_masuk dari tbreturnbeli
            $table->dropColumn('id_masuk');
        });
    }
}

