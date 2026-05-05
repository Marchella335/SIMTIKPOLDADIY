<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->string('perihal')->nullable()->after('jenis_surat');
            $table->string('dari')->nullable()->after('perihal');
            $table->string('kepada')->nullable()->after('dari');
        });
    }

    public function down(): void
    {
        Schema::table('surats', function (Blueprint $table) {
            $table->dropColumn(['perihal', 'dari', 'kepada']);
        });
    }
};
