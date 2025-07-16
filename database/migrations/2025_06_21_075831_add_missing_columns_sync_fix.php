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
        // Add is_active to qrcodes table if it doesn't exist
        if (!Schema::hasColumn('qrcodes', 'is_active')) {
            Schema::table('qrcodes', function (Blueprint $table) {
                $table->boolean('is_active')->default(true)->after('expired_at');
            });
        }

        // Add foto to mahasiswa table if it doesn't exist
        if (!Schema::hasColumn('mahasiswa', 'foto')) {
            Schema::table('mahasiswa', function (Blueprint $table) {
                $table->string('foto')->nullable()->after('jurusan');
            });
        }

        // Add foto to dosen table if it doesn't exist
        if (!Schema::hasColumn('dosen', 'foto')) {
            Schema::table('dosen', function (Blueprint $table) {
                $table->string('foto')->nullable()->after('nidn');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration is for fixing missing columns, reversing is not recommended
        // as it might cause data loss. If needed, columns can be dropped manually.
    }
};
