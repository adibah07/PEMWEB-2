<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Dosen;
use App\Models\Mahasiswa;
use App\Models\Matakuliah;
use App\Models\Jadwal;

class TestDataSeeder extends Seeder
{
    public function run()
    {
        // Buat user dosen
        $user = User::create([
            'name' => 'Dr. Ahmad Sudirman',
            'email' => 'dosen@test.com',
            'password' => bcrypt('password123'),
            'role' => 'dosen',
        ]);

        // Buat record dosen
        $dosen = Dosen::create([
            'user_id' => $user->id,
            'nidn' => '0123456789',
        ]);

        // Buat mata kuliah
        $matakuliah1 = Matakuliah::create([
            'nama' => 'Pemrograman Web',
            'kode' => 'IF301',
            'dosen_id' => $dosen->id,
        ]);

        $matakuliah2 = Matakuliah::create([
            'nama' => 'Basis Data',
            'kode' => 'IF302',
            'dosen_id' => $dosen->id,
        ]);        // Buat jadwal dengan tanggal
        Jadwal::create([
            'matakuliah_id' => $matakuliah1->id,
            'tanggal' => now()->addDays(1), // Besok
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'ruangan' => 'Lab Komputer 1',
        ]);

        Jadwal::create([
            'matakuliah_id' => $matakuliah1->id,
            'tanggal' => now()->addDays(3), // 3 hari lagi
            'jam_mulai' => '10:00:00',
            'jam_selesai' => '12:00:00',
            'ruangan' => 'Lab Komputer 2',
        ]);

        Jadwal::create([
            'matakuliah_id' => $matakuliah2->id,
            'tanggal' => now()->addDays(2), // 2 hari lagi
            'jam_mulai' => '13:00:00',
            'jam_selesai' => '15:00:00',
            'ruangan' => 'Ruang A301',
        ]);

        Jadwal::create([
            'matakuliah_id' => $matakuliah2->id,
            'tanggal' => now()->addDays(4), // 4 hari lagi
            'jam_mulai' => '08:00:00',
            'jam_selesai' => '10:00:00',
            'ruangan' => 'Ruang A302',
        ]);

        // Buat beberapa mahasiswa
        $mahasiswa1 = User::create([
            'name' => 'Budi Santoso',
            'email' => 'budi@student.com',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa1->id,
            'nim' => '2021001',
            'kelas' => 'IF-3A',
            'jurusan' => 'Teknik Informatika',
        ]);

        $mahasiswa2 = User::create([
            'name' => 'Siti Aminah',
            'email' => 'siti@student.com',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa2->id,
            'nim' => '2021002',
            'kelas' => 'IF-3A',
            'jurusan' => 'Teknik Informatika',
        ]);

        $mahasiswa3 = User::create([
            'name' => 'Andi Pratama',
            'email' => 'andi@student.com',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa3->id,
            'nim' => '2021003',
            'kelas' => 'IF-3B',
            'jurusan' => 'Teknik Informatika',
        ]);

        $mahasiswa4 = User::create([
            'name' => 'Dewi Sartika',
            'email' => 'dewi@student.com',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa',
        ]);

        Mahasiswa::create([
            'user_id' => $mahasiswa4->id,
            'nim' => '2021004',
            'kelas' => 'IF-3B',
            'jurusan' => 'Teknik Informatika',
        ]);

        echo "Data test berhasil dibuat!\n";
        echo "Login dengan: dosen@test.com / password123\n";
    }
}
