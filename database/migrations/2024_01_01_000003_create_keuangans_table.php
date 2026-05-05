<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keuangans', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->string('uraian_kegiatan');
            $table->enum('jenis', ['perangkat', 'jaringan', 'sistem']);
            $table->string('kode')->nullable();
            $table->string('status')->nullable();
            $table->decimal('nilai', 15, 2)->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keuangans');
    }
};
