<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // 1. Add fields to 'rencana_kegiatans'
        Schema::table('rencana_kegiatans', function (Blueprint $table) {
            if (!Schema::hasColumn('rencana_kegiatans', 'tipe')) {
                $table->string('tipe')->default('kegiatan'); // 'kegiatan' or 'berita'
            }
            if (!Schema::hasColumn('rencana_kegiatans', 'kategori')) {
                $table->string('kategori')->nullable(); // news category
            }
        });

        // 2. Migrate existing data if 'rencana_beritas' exists
        if (Schema::hasTable('rencana_beritas')) {
            $beritas = DB::table('rencana_beritas')->get();
            foreach ($beritas as $berita) {
                DB::table('rencana_kegiatans')->insert([
                    'nama_kegiatan' => $berita->judul_rencana,
                    'tanggal_rencana' => $berita->tanggal_rencana,
                    'tempat' => null,
                    'kategori' => $berita->kategori,
                    'keterangan' => $berita->keterangan,
                    'status' => $berita->status,
                    'tipe' => 'berita',
                    'created_at' => $berita->created_at,
                    'updated_at' => $berita->updated_at,
                ]);
            }

            // 3. Drop 'rencana_beritas' table
            Schema::dropIfExists('rencana_beritas');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // 1. Recreate 'rencana_beritas' table
        if (!Schema::hasTable('rencana_beritas')) {
            Schema::create('rencana_beritas', function (Blueprint $table) {
                $table->id();
                $table->string('judul_rencana');
                $table->date('tanggal_rencana');
                $table->string('kategori')->nullable();
                $table->text('keterangan')->nullable();
                $table->string('status')->default('dijadwalkan');
                $table->timestamps();
            });
        }

        // 2. Move 'berita' data back to 'rencana_beritas'
        if (Schema::hasColumn('rencana_kegiatans', 'tipe')) {
            $beritaItems = DB::table('rencana_kegiatans')->where('tipe', 'berita')->get();
            foreach ($beritaItems as $item) {
                DB::table('rencana_beritas')->insert([
                    'judul_rencana' => $item->nama_kegiatan,
                    'tanggal_rencana' => $item->tanggal_rencana,
                    'kategori' => $item->kategori,
                    'keterangan' => $item->keterangan,
                    'status' => $item->status,
                    'created_at' => $item->created_at,
                    'updated_at' => $item->updated_at,
                ]);
            }

            // 3. Delete 'berita' data from 'rencana_kegiatans'
            DB::table('rencana_kegiatans')->where('tipe', 'berita')->delete();
        }

        // 4. Drop columns from 'rencana_kegiatans'
        Schema::table('rencana_kegiatans', function (Blueprint $table) {
            if (Schema::hasColumn('rencana_kegiatans', 'tipe')) {
                $table->dropColumn('tipe');
            }
            if (Schema::hasColumn('rencana_kegiatans', 'kategori')) {
                $table->dropColumn('kategori');
            }
        });
    }
};
