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
        Schema::table('layanans', function (Blueprint $table) {
            $table->string('nama_pemohon')->after('id');
            $table->string('email_pemohon')->after('nama_pemohon');
            $table->string('no_hp')->nullable()->after('email_pemohon');
            $table->string('token')->unique()->after('feedback');
            $table->foreignId('anggota_id')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('layanans', function (Blueprint $table) {
            $table->dropColumn(['nama_pemohon', 'email_pemohon', 'no_hp', 'token']);
        });
    }
};
