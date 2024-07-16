<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdUserForeignToTbpesanandetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbpesanandetail', function (Blueprint $table) {
            // Tambah kolom id_user setelah kolom id
            $table->unsignedBigInteger('id_user')->after('id');

            // Tambah foreign key constraint ke tabel tbpesanans
            $table->foreign('id_user')->references('id_user')->on('tbpesanans')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbpesanandetail', function (Blueprint $table) {
            // Hapus foreign key constraint
            $table->dropForeign(['id_user']);

            // Hapus kolom id_user
            $table->dropColumn('id_user');
        });
    }
}
