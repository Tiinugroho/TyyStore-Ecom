<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddVendorIdToTbstokrekapsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbstokrekap', function (Blueprint $table) {
            $table->unsignedBigInteger('id_vendor')->after('id_barang');

            // Menambahkan foreign key constraint
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
        Schema::table('tbstokrekap', function (Blueprint $table) {
            // Menghapus foreign key constraint
            $table->dropForeign(['id_vendor']);
            // Menghapus kolom id_vendor
            $table->dropColumn('id_vendor');
        });
    }
}
