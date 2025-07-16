<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditDosen extends EditRecord
{
    protected static string $resource = DosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load data user untuk form
        $dosen = $this->record;
        $data['user'] = [
            'name' => $dosen->user->name,
            'email' => $dosen->user->email,
            'password' => '', // Jangan tampilkan password
        ];

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update data user
        $dosen = $this->record;
        $userUpdateData = [
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
        ];

        // Hanya update password jika diisi
        if (!empty($data['user']['password'])) {
            $userUpdateData['password'] = bcrypt($data['user']['password']);
        }

        $dosen->user->update($userUpdateData);

        // Handle foto
        if (!empty($data['foto_upload'])) {
            // Ada foto baru diupload
            // Hapus foto lama jika ada
            if ($dosen->foto && Storage::disk('public')->exists($dosen->foto)) {
                Storage::disk('public')->delete($dosen->foto);
            }
            $data['foto'] = $data['foto_upload'];
        } else {
            // Tidak ada foto baru, pertahankan foto lama
            $data['foto'] = $data['foto_existing'];
        }

        // Hapus field sementara
        unset($data['user'], $data['foto_upload'], $data['foto_existing'], $data['has_new_photo']);

        return $data;
    }
}
