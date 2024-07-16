<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddUserIdToTbStokRekapTable extends Migration
{
    public function up()
    {
        Schema::table('tbstokrekap', function (Blueprint $table) {
            $table->unsignedBigInteger('id_user');

            $table->foreign('id_user')->references('id')->on('users')->onDelete('cascade'); // Jika user dihapus, hapus juga tbstokrekap yang terkait
        });
    }

    public function down()
    {
        Schema::table('tbstokrekap', function (Blueprint $table) {
            $table->dropForeign(['id_user']);
            $table->dropColumn('id_user');
        });
    }
}
