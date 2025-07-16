<?php

namespace App\Filament\Resources\MahasiswaResource\Pages;

use App\Filament\Resources\MahasiswaResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\Grid;
use Filament\Support\Enums\FontWeight;

class ViewMahasiswa extends ViewRecord
{
    protected static string $resource = MahasiswaResource::class;

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
                Section::make('Informasi Mahasiswa')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                ImageEntry::make('foto')
                                    ->label('Foto')
                                    ->circular()
                                    ->size(120)
                                    ->disk('public')
                                    ->defaultImageUrl(asset('images/default-avatar.svg'))
                                    ->columnSpan(1),
                                    
                                Grid::make(1)
                                    ->schema([
                                        TextEntry::make('user.name')
                                            ->label('Nama Lengkap')
                                            ->weight(FontWeight::Bold)
                                            ->size('lg'),
                                        TextEntry::make('nim')
                                            ->label('NIM')
                                            ->badge()
                                            ->color('primary'),
                                        TextEntry::make('user.email')
                                            ->label('Email')
                                            ->icon('heroicon-o-envelope'),
                                    ])
                                    ->columnSpan(2),
                            ]),
                    ])
                    ->columns(3),

                Section::make('Data Akademik')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('kelas')
                                    ->label('Kelas')
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-o-academic-cap'),
                                TextEntry::make('jurusan')
                                    ->label('Program Studi')
                                    ->badge()
                                    ->color('info')
                                    ->icon('heroicon-o-building-library'),
                            ]),
                    ])
                    ->columns(2),

                Section::make('Statistik Absensi')
                    ->schema([
                        Grid::make(3)
                            ->schema([
                                TextEntry::make('total_absensi')
                                    ->label('Total Absensi')
                                    ->formatStateUsing(fn ($record) => $record->absensi()->count())
                                    ->badge()
                                    ->color('primary')
                                    ->icon('heroicon-o-clipboard-document-list')
                                    ->size('lg'),
                                TextEntry::make('hadir_bulan_ini')
                                    ->label('Hadir Bulan Ini')
                                    ->formatStateUsing(function ($record) {
                                        return $record->absensi()
                                            ->where('status', 'hadir')
                                            ->whereMonth('tanggal', now()->month)
                                            ->whereYear('tanggal', now()->year)
                                            ->count();
                                    })
                                    ->badge()
                                    ->color('success')
                                    ->icon('heroicon-o-check-circle')
                                    ->size('lg'),
                                TextEntry::make('persentase_kehadiran')
                                    ->label('Persentase Kehadiran')
                                    ->formatStateUsing(function ($record) {
                                        $totalAbsensi = $record->absensi()->count();
                                        if ($totalAbsensi === 0) return '0%';
                                        
                                        $hadir = $record->absensi()->where('status', 'hadir')->count();
                                        $persentase = round(($hadir / $totalAbsensi) * 100, 1);
                                        return $persentase . '%';
                                    })
                                    ->badge()
                                    ->color(function ($record) {
                                        $totalAbsensi = $record->absensi()->count();
                                        if ($totalAbsensi === 0) return 'gray';
                                        
                                        $hadir = $record->absensi()->where('status', 'hadir')->count();
                                        $persentase = ($hadir / $totalAbsensi) * 100;
                                        
                                        if ($persentase >= 80) return 'success';
                                        if ($persentase >= 60) return 'warning';
                                        return 'danger';
                                    })
                                    ->icon('heroicon-o-chart-pie')
                                    ->size('lg'),
                            ])
                    ])
                    ->columns(3),

                Section::make('Informasi Sistem')
                    ->schema([
                        Grid::make(2)
                            ->schema([
                                TextEntry::make('created_at')
                                    ->label('Terdaftar Sejak')
                                    ->dateTime('d F Y, H:i')
                                    ->icon('heroicon-o-calendar'),
                                TextEntry::make('updated_at')
                                    ->label('Terakhir Diupdate')
                                    ->dateTime('d F Y, H:i')
                                    ->icon('heroicon-o-pencil'),
                            ])
                    ])
                    ->collapsible()
                    ->collapsed(),
            ]);
    }
}
