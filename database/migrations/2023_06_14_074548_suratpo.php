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
    Schema::create('suratpo', function (Blueprint $table) {
        $table->string('kode_po', 25)->primary(); 
        $table->unsignedInteger('id_supplier');
        $table->string('periode', 40); 
        $table->date('tanggal_po');
        $table->enum('status', ['NotValidate', 'Validated'])->default('NotValidate');
        $table->string('keterangan_po', 100)->nullable(); 
        $table->timestamps();

        $table->foreign('id_supplier')->references('id_supplier')->on('suppliers');
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suratpo');
    }
};
