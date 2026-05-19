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
        Schema::rename('pangkats', 'jabatans');
        Schema::table('jabatans', function (Blueprint $table) {
            $table->renameColumn('nama_pangkat', 'nama_jabatan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jabatans', function (Blueprint $table) {
            $table->renameColumn('nama_jabatan', 'nama_pangkat');
        });
        Schema::rename('jabatans', 'pangkats');
    }
};
