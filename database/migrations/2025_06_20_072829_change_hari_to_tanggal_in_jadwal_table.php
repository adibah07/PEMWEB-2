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
        Schema::table('jadwal', function (Blueprint $table) {
            // Tambahkan kolom tanggal dulu sebagai nullable
            $table->date('tanggal')->nullable()->after('matakuliah_id');
        });
        
        // Update data existing dengan tanggal hari ini sebagai contoh
        // Bisa disesuaikan dengan kebutuhan
        DB::table('jadwal')->update([
            'tanggal' => now()->format('Y-m-d')
        ]);
        
        Schema::table('jadwal', function (Blueprint $table) {
            // Setelah data terupdate, ubah kolom jadi not null dan hapus kolom hari
            $table->date('tanggal')->nullable(false)->change();
            $table->dropColumn('hari');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('jadwal', function (Blueprint $table) {
            // Kembalikan ke kolom hari
            $table->dropColumn('tanggal');
            $table->enum('hari', ['Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'])->after('matakuliah_id');
        });
    }
};
