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
        // Membuat tabel hewan
        Schema::create('hewan', function (Blueprint $table) {
            $table->id('id_hewan');
            $table->string('nama_hewan', 100);
            $table->string('spesies', 100);
            $table->enum('jenis_kelamin', ['Jantan', 'Betina']);
            $table->date('tanggal_lahir');
            $table->unsignedBigInteger('id_kandang');
            $table->timestamps();

            // Foreign key constraint
            $table->foreign('id_kandang')
                  ->references('id_kandang')
                  ->on('kandang')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_hewan');
    }
};
