<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@dashboard-absen.com'],
            [
                'name' => 'Admin Dashboard',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'status' => 'normal',
            ]
        );

        // Mahasiswa 1
        $mahasiswa1 = User::updateOrCreate(
            ['email' => 'ahmad.fauzi@student.ac.id'],
            [
                'name' => 'Ahmad Fauzi',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'status' => 'normal',
            ]
        );

        // Mahasiswa 2
        $mahasiswa2 = User::updateOrCreate(
            ['email' => 'siti.nurhaliza@student.ac.id'],
            [
                'name' => 'Siti Nurhaliza',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'status' => 'ketua_kelas',
            ]
        );

        // Mahasiswa 3
        $mahasiswa3 = User::updateOrCreate(
            ['email' => 'budi.santoso@student.ac.id'],
            [
                'name' => 'Budi Santoso',
                'password' => Hash::make('password'),
                'role' => 'mahasiswa',
                'status' => 'normal',
            ]
        );

        // Buat record Mahasiswa (gunakan updateOrCreate juga)
        Mahasiswa::updateOrCreate(
            ['user_id' => $mahasiswa1->id],
            [
                'nim' => '2021001',
                'kelas' => '3A',
                'jurusan' => 'Teknik Informatika',
            ]
        );

        Mahasiswa::updateOrCreate(
            ['user_id' => $mahasiswa2->id],
            [
                'nim' => '2021002',
                'kelas' => '3A',
                'jurusan' => 'Teknik Informatika',
            ]
        );

        Mahasiswa::updateOrCreate(
            ['user_id' => $mahasiswa3->id],
            [
                'nim' => '2021003',
                'kelas' => '3B',
                'jurusan' => 'Sistem Informasi',
            ]
        );
    }
}
