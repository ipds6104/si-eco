<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Add SLS to regions type enum (use raw query because enum change is tricky in some SQL versions)
        DB::statement("ALTER TABLE regions MODIFY COLUMN type ENUM('KABUPATEN', 'KECAMATAN', 'DESA', 'SLS')");

        // 2. Add sls_id to kuesioners table
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->unsignedBigInteger('sls_id')->nullable()->after('desa_id');
        });
    }

    public function down(): void
    {
        Schema::table('kuesioners', function (Blueprint $table) {
            $table->dropColumn('sls_id');
        });

        DB::statement("ALTER TABLE regions MODIFY COLUMN type ENUM('KABUPATEN', 'KECAMATAN', 'DESA')");
    }
};
