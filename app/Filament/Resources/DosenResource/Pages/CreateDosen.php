<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateDosen extends CreateRecord
{
    protected static string $resource = DosenResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        // Buat user terlebih dahulu
        $user = User::create([
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'password' => bcrypt($data['user']['password']),
            'role' => 'dosen',
        ]);

        // Set user_id untuk dosen
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
