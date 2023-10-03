<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('barang_suratpo', function (Blueprint $table) {
        $table->increments('id');
        $table->string('id_suratpo', 25); 
        $table->unsignedInteger('penerimaan_id')->nullable();
        $table->unsignedInteger('id_barang');
        $table->integer('quantity_po');
        $table->integer('quantity_kirim')->default(0);
        $table->integer('price');
        $table->integer('total_price');
        $table->date('jadwal_barang')->nullable();
        $table->enum('status_deliv', ['pending','proses','dikirim', 'datang', 'selesai'])->default('pending');
        $table->timestamps();

        $table->foreign('id_suratpo')->references('kode_po')->on('suratpo')->onDelete('cascade');
        $table->foreign('penerimaan_id')->references('id')->on('penerimaan')->onDelete('cascade');
        $table->foreign('id_barang')->references('id_barang')->on('barang')->onDelete('cascade');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('barang_suratpo');
    }
};
