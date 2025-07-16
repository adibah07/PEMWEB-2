<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Mahasiswa;
use App\Models\Dosen;
use App\Models\Matakuliah;
use App\Models\Jadwal;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create Admin
        $admin = User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
            'role' => 'admin'
        ]);

        // Create Dosen
        $dosenUser = User::create([
            'name' => 'Dr. John Doe',
            'email' => 'dosen@example.com',
            'password' => Hash::make('password'),
            'role' => 'dosen'
        ]);

        $dosen = Dosen::create([
            'user_id' => $dosenUser->id,
            'nidn' => '1234567890'
        ]);

        // Create Mahasiswa
        $mahasiswaUser = User::create([
            'name' => 'Jane Smith',
            'email' => 'mahasiswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'mahasiswa'
        ]);

        $mahasiswa = Mahasiswa::create([
            'user_id' => $mahasiswaUser->id,
            'nim' => '12345678',
            'kelas' => 'TI-3A',
            'jurusan' => 'Teknik Informatika'
        ]);

        // Create Matakuliah
        $matakuliah = Matakuliah::create([
            'nama' => 'Pemrograman Web',
            'kode' => 'TI301',
            'dosen_id' => $dosen->id
        ]);

        // Create Jadwal
        Jadwal::create([
            'matakuliah_id' => $matakuliah->id,
            'tanggal' => '2025-10-02',
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'ruangan' => 'Lab Komputer 1'
        ]);

        Jadwal::create([
            'matakuliah_id' => $matakuliah->id,
            'tanggal' => '2025-10-03',
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'ruangan' => 'Lab Komputer 2'
        ]);
    }
}
