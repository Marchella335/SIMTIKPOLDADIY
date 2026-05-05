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
        Schema::create('sumber_danas', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->decimal('pagu', 15, 2);
            $table->integer('tahun');
            $table->timestamps();
        });

        Schema::table('keuangan_acaras', function (Blueprint $table) {
            $table->foreignId('sumber_dana_id')->nullable()->after('id')->constrained('sumber_danas')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::table('keuangan_acaras', function (Blueprint $table) {
            $table->dropForeign(['sumber_dana_id']);
            $table->dropColumn('sumber_dana_id');
        });
        Schema::dropIfExists('sumber_danas');
    }
};
