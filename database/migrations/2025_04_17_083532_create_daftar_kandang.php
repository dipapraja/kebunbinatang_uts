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
        // Membuat tabel kandang
        Schema::create('kandang', function (Blueprint $table) {
            $table->id('id_kandang');
            $table->string('nama_kandang', 100);
            $table->string('tipe_kandang', 100);
            $table->integer('kapasitas');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daftar_kandang');
    }
};
