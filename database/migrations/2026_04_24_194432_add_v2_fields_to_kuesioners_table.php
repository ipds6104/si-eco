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
            $table->string('jumlah_tk')->nullable();
            $table->string('tahun_mulai')->nullable();
            $table->string('legalitas')->nullable();
            $table->text('kendala')->nullable();
            $table->string('se2026_visit')->nullable();
            $table->string('use_digital')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropColumn(['jumlah_tk', 'tahun_mulai', 'legalitas', 'kendala', 'se2026_visit', 'use_digital']);
        });
    }
};
