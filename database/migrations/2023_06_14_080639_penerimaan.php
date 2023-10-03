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
    Schema::create('penerimaan', function (Blueprint $table) {
        $table->increments('id');
        $table->string('id_suratpo', 40); 
        $table->string('suratjalan', 50); 
        $table->date('tanggal_terima');
        $table->timestamps();

        $table->foreign('id_suratpo')->references('kode_po')->on('suratpo')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penerimaan');
    }
};
