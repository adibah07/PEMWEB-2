<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;

class MahasiswaSeeder extends Seeder
{
    public function run()
    {
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

        $mahasiswa5 = User::create([
            'name' => 'Rizki Hidayat',
            'email' => 'rizki@student.com',
            'password' => bcrypt('password123'),
            'role' => 'mahasiswa',
        ]);
        
        Mahasiswa::create([
            'user_id' => $mahasiswa5->id,
            'nim' => '2021005',
            'kelas' => 'IF-3A',
            'jurusan' => 'Teknik Informatika',
        ]);

        echo "Data mahasiswa berhasil dibuat!\n";
    }
}
