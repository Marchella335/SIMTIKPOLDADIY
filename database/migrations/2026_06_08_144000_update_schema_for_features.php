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
        // 1. Add 'tampilkan' to 'beritas'
        if (Schema::hasTable('beritas') && !Schema::hasColumn('beritas', 'tampilkan')) {
            Schema::table('beritas', function (Blueprint $table) {
                $table->boolean('tampilkan')->default(true);
            });
        }

        // 2. Add 'tampilkan' and 'hasil' to 'kegiatans'
        if (Schema::hasTable('kegiatans')) {
            Schema::table('kegiatans', function (Blueprint $table) {
                if (!Schema::hasColumn('kegiatans', 'tampilkan')) {
                    $table->boolean('tampilkan')->default(true);
                }
                if (!Schema::hasColumn('kegiatans', 'hasil')) {
                    $table->text('hasil')->nullable();
                }
            });
        }

        // 3. Add 'jobdesk' to 'anggotas'
        if (Schema::hasTable('anggotas') && !Schema::hasColumn('anggotas', 'jobdesk')) {
            Schema::table('anggotas', function (Blueprint $table) {
                $table->text('jobdesk')->nullable();
            });
        }

        // 4. Add fields to 'surats' (nomor_agenda, tanggal_agenda, disposisi, status_terusan, diteruskan_dari)
        if (Schema::hasTable('surats')) {
            Schema::table('surats', function (Blueprint $table) {
                if (!Schema::hasColumn('surats', 'nomor_agenda')) {
                    $table->string('nomor_agenda')->nullable();
                }
                if (!Schema::hasColumn('surats', 'tanggal_agenda')) {
                    $table->date('tanggal_agenda')->nullable();
                }
                if (!Schema::hasColumn('surats', 'disposisi')) {
                    $table->text('disposisi')->nullable();
                }
                if (!Schema::hasColumn('surats', 'status_terusan')) {
                    $table->string('status_terusan')->nullable(); // 'tekkom', 'tekinfo', etc.
                }
            });
        }

        // 5. Add 'kuota' to 'jabatans'
        if (Schema::hasTable('jabatans') && !Schema::hasColumn('jabatans', 'kuota')) {
            Schema::table('jabatans', function (Blueprint $table) {
                $table->integer('kuota')->default(0);
            });
        }

        // 6. Create 'rencana_kegiatans' table
        if (!Schema::hasTable('rencana_kegiatans')) {
            Schema::create('rencana_kegiatans', function (Blueprint $table) {
                $table->id();
                $table->string('nama_kegiatan');
                $table->date('tanggal_rencana');
                $table->string('tempat')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('status')->default('dijadwalkan'); // dijadwalkan, selesai, batal
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop 'rencana_kegiatans'
        Schema::dropIfExists('rencana_kegiatans');

        // Drop added columns if supported by DB (SQLite has limitations, but we can try or omit in sqlite down)
        if (Schema::hasTable('jabatans') && Schema::hasColumn('jabatans', 'kuota')) {
            Schema::table('jabatans', function (Blueprint $table) {
                $table->dropColumn('kuota');
            });
        }
        // Other drops omitted for simplicity due to SQLite limitations on dropColumn
    }
};
