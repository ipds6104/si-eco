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
            $table->string('lama_aktivitas_digital')->nullable()->change();
            $table->string('omzet')->nullable()->change();
            $table->string('tambah_penghasilan_digital')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->integer('lama_aktivitas_digital')->nullable()->change();
            // omzet was originally string, so no need to change back to integer
        });
    }
};
