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
        Schema::table('keuangan_acaras', function (Blueprint $table) {
            $table->string('sumber_dana')->nullable()->after('dana_awal');
            $table->string('periode_pelaporan')->nullable()->after('sumber_dana');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('keuangan_acaras', function (Blueprint $table) {
            $table->dropColumn(['sumber_dana', 'periode_pelaporan']);
        });
    }
};
