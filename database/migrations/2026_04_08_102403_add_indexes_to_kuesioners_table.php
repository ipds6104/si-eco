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
            $table->index('punya_usaha');
            $table->index('ikut_komunitas');
            $table->index('is_producer');
            $table->index('jenis_usaha');
        });
    }

    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropIndex(['punya_usaha']);
            $table->dropIndex(['ikut_komunitas']);
            $table->dropIndex(['is_producer']);
            $table->dropIndex(['jenis_usaha']);
        });
    }
};
