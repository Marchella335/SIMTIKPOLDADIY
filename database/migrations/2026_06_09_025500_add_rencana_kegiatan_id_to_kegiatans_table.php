<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->unsignedBigInteger('rencana_kegiatan_id')->nullable()->after('id');
            $table->foreign('rencana_kegiatan_id')
                  ->references('id')
                  ->on('rencana_kegiatans')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('kegiatans', function (Blueprint $table) {
            $table->dropForeign(['rencana_kegiatan_id']);
            $table->dropColumn('rencana_kegiatan_id');
        });
    }
};
