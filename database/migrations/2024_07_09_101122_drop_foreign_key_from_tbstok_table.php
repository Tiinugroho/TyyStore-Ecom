<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropForeignKeyFromTbstokTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tbstok', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['id_vendor']);
            
            // Drop the column if necessary
            $table->dropColumn('id_vendor');
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
            // Add the column back
            $table->unsignedBigInteger('id_vendor')->nullable();

            // Add foreign key constraint
            $table->foreign('id_vendor')->references('id')->on('tbpemasok');
        });
    }
}
