<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateMahasiswa extends CreateRecord
{
    protected static string $resource = MahasiswaResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => bcrypt($data['user']['password']),
            'role' => 'mahasiswa',
            'status' => $data['user']['status'] ?? 'normal',
        ]);

        // Set user_id untuk mahasiswa
        $data['user_id'] = $user->id;

        // Handle foto
        if (!empty($data['foto_upload'])) {
            $data['foto'] = $data['foto_upload'];
        }

        // Hapus field sementara
        unset($data['user'], $data['foto_upload'], $data['foto_existing'], $data['has_new_photo']);

        return $data;
    }
}
