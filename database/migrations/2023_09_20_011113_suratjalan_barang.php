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
        Schema::create('suratjalan_barang', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('id_suratjalan');
            $table->unsignedInteger('id_barang_suratpo');


            $table->foreign('id_suratjalan')->references('id_suratjalan')->on('suratjalan')->onDelete('cascade');
            $table->foreign('id_barang_suratpo')->references('id')->on('barang_suratpo')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratjalan_barang');
    }
};
