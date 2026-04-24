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
        Schema::table('kuesioners', function (Blueprint $table) {
            if (!Schema::hasColumn('kuesioners', 'lama_aktivitas_digital')) {
                $table->integer('lama_aktivitas_digital')->nullable();
            }
            if (!Schema::hasColumn('kuesioners', 'tambah_penghasilan_digital')) {
                $table->enum('tambah_penghasilan_digital', ['ya', 'tidak'])->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropColumn(['lama_aktivitas_digital', 'tambah_penghasilan_digital']);
        });
    }
};
