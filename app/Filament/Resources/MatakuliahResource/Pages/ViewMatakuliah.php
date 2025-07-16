<?php

namespace App\Filament\Resources\MatakuliahResource\Pages;

use App\Filament\Resources\MatakuliahResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewMatakuliah extends ViewRecord
{
    protected static string $resource = MatakuliahResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}
