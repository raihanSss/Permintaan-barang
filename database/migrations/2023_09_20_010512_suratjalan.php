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
        Schema::create('suratjalan', function (Blueprint $table) {
            $table->increments('id_suratjalan');
            $table->string('kode_Suratjalan', 25)->unique();
            $table->date('tanggal_kirim');
            $table->text('keterangan')->nullable();
            $table->enum('status', ['pending', 'diterima'])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratjalan');
    }
};
