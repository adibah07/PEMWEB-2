<?php

namespace App\Filament\Resources\DosenResource\Pages;

use App\Filament\Resources\DosenResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Grid;
use Filament\Support\Enums\FontWeight;

class ViewDosen extends ViewRecord
{
    protected static string $resource = DosenResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Foto Profil')
                    ->schema([
                        ImageEntry::make('foto')
                            ->label('')
                            ->disk('public')
                            ->size(200)
                            ->width(200)
                            ->circular()
                            ->defaultImageUrl(asset('images/default-avatar.svg'))
                            ->extraAttributes(['class' => 'mx-auto'])
                    ])
                    ->compact()
                    ->columnSpanFull(),

                Section::make('Informasi Personal')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('user.name')
                                    ->label('Nama Lengkap')
                                    ->weight(FontWeight::Bold)
                                    ->size('lg')
                                    ->icon('heroicon-o-user'),
                                
                                TextEntry::make('user.email')
                                    ->label('Email')
                                    ->icon('heroicon-o-envelope')
                                    ->copyable(),
                            ]),
                        
                        TextEntry::make('nidn')
                            ->label('NIDN (Nomor Induk Dosen Nasional)')
                            ->badge()
                            ->color('primary')
                            ->icon('heroicon-o-identification'),
                    ])
                    ->columns(1),

            ]);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load relasi yang diperlukan
        $this->record->load(['user', 'matakuliah']);
        return $data;
    }
}
