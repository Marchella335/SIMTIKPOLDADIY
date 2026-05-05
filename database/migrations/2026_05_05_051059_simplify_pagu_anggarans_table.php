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
        Schema::table('pagu_anggarans', function (Blueprint $table) {
            $table->dropColumn(['realisasi_anggaran', 'paket_pengadaan', 'aset_tik_tercatat']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pagu_anggarans', function (Blueprint $table) {
            $table->decimal('realisasi_anggaran', 15, 2)->default(0);
            $table->integer('paket_pengadaan')->default(0);
            $table->integer('aset_tik_tercatat')->default(0);
        });
    }
};
