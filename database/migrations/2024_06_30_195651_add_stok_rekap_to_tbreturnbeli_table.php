<?php 
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStokRekapToTbreturnbeliTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            $table->unsignedBigInteger('id_stok_rekap')->nullable();
            $table->foreign('id_stok_rekap')->references('id')->on('tbstokrekap')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tbreturnbeli', function (Blueprint $table) {
            $table->dropForeign(['id_stok_rekap']);
            $table->dropColumn('id_stok_rekap');
        });
    }
}
