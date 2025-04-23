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
        Schema::table('hewan', function (Blueprint $table) {
            // Hapus foreign key lama jika ada
            $table->dropForeign(['id_kandang']);
            
            // Tambahkan foreign key baru dengan cascade
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
        Schema::table('hewan', function (Blueprint $table) {
            $table->dropForeign(['id_kandang']);
            
            // Kembalikan ke foreign key tanpa cascade (opsional)
            $table->foreign('id_kandang')
                  ->references('id_kandang')
                  ->on('kandang');
        });
    }
};
