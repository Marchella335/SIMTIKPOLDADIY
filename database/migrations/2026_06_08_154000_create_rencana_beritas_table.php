<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('rencana_beritas')) {
            Schema::create('rencana_beritas', function (Blueprint $table) {
                $table->id();
                $table->string('judul_rencana');
                $table->date('tanggal_rencana');
                $table->string('kategori')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('status')->default('dijadwalkan'); // dijadwalkan, selesai, batal
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('rencana_beritas');
    }
};
