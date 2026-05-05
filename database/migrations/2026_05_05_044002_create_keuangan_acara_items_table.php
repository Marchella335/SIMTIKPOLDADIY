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
        Schema::create('keuangan_acara_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('keuangan_acara_id')->constrained('keuangan_acaras')->cascadeOnDelete();
            $table->date('tanggal')->nullable();
            $table->string('uraian')->nullable();
            $table->string('kategori')->nullable();
            $table->string('tipe')->default('Pengeluaran'); // Pemasukan / Pengeluaran
            $table->decimal('nilai', 15, 2)->default(0);
            $table->string('keterangan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('keuangan_acara_items');
    }
};
