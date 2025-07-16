<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditMahasiswa extends EditRecord
{
    protected static string $resource = MahasiswaResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load data user untuk form
        $mahasiswa = $this->record;
        $data['user'] = [
            'name' => $mahasiswa->user->name,
            'email' => $mahasiswa->user->email,
            'password' => '', // Jangan tampilkan password
            'status' => $mahasiswa->user->status ?? 'normal',
        ];

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        // Update data user
        $mahasiswa = $this->record;
        $userUpdateData = [
            'name' => $data['user']['name'],
            'email' => $data['user']['email'],
            'status' => $data['user']['status'] ?? 'normal',
        ];

        // Hanya update password jika diisi
        if (!empty($data['user']['password'])) {
            $userUpdateData['password'] = bcrypt($data['user']['password']);
        }

        $mahasiswa->user->update($userUpdateData);

        // Handle foto
        if (!empty($data['foto_upload'])) {
            // Ada foto baru diupload
            // Hapus foto lama jika ada
            if ($mahasiswa->foto && Storage::disk('public')->exists($mahasiswa->foto)) {
                Storage::disk('public')->delete($mahasiswa->foto);
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
