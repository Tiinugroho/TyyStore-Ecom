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
        Schema::create('tbcheckoutreturn', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_checkout');
            $table->string('status')->default('return');
            $table->timestamps();

            $table->foreign('id_checkout')->references('id')->on('tbcheckoutdetail')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tbcheckoutreturn');
    }
};
