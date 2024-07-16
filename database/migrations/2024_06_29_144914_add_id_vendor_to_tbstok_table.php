<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddIdVendorToTbstokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbstok', function (Blueprint $table) {
            // Menambahkan kolom id_vendor
            $table->unsignedBigInteger('id_vendor')->nullable();

            // Membuat foreign key dari id_vendor ke id di tbpemasok
            $table->foreign('id_vendor')->references('id')->on('tbpemasok')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbstok', function (Blueprint $table) {
            // Menghapus foreign key dan kolom id_vendor
            $table->dropForeign(['id_vendor']);
            $table->dropColumn('id_vendor');
        });
    }
}
