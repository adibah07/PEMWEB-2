<?php

namespace App\Filament\Resources\JadwalResource\Pages;

use App\Filament\Resources\JadwalResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\RepeatableEntry;
use Filament\Infolists\Components\Grid;
use Filament\Support\Enums\FontWeight;
use Filament\Forms;
use Filament\Forms\Form;
use App\Models\Absensi;

class ViewJadwal extends ViewRecord
{
    protected static string $resource = JadwalResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        // Load relasi yang diperlukan
        $this->record->load(['mahasiswa.user', 'matakuliah.dosen.user', 'absensi.mahasiswa.user']);
        return $data;
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Informasi Jadwal Kuliah')
                    ->description('Detail informasi mata kuliah dan jadwal pertemuan')
                    ->icon('heroicon-o-calendar-days')
                    ->schema([
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('matakuliah.kode')
                                    ->label('Kode Mata Kuliah')
                                    ->disabled()
                                    ->dehydrated(false),
                                
                                Forms\Components\TextInput::make('matakuliah.nama')
                                    ->label('Nama Mata Kuliah')
                                    ->disabled()
                                    ->dehydrated(false),
                            ]),
                        
                        Forms\Components\TextInput::make('matakuliah.dosen.user.name')
                            ->label('Dosen Pengampu')
                            ->disabled()
                            ->dehydrated(false),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('hari')
                                    ->label('Hari Perkuliahan')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(fn ($state) => $state ?: 'Belum ditentukan'),
                                
                                Forms\Components\TextInput::make('ruangan')
                                    ->label('Ruang Kuliah')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(fn ($state) => $state ?: 'Belum ditentukan'),
                            ]),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('jam_mulai')
                                    ->label('Jam Mulai')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(fn ($state) => $state ? $state->format('H:i') : 'Belum ditentukan'),
                                
                                Forms\Components\TextInput::make('jam_selesai')
                                    ->label('Jam Selesai')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(fn ($state) => $state ? $state->format('H:i') : 'Belum ditentukan'),
                            ]),
                        
                        Forms\Components\Grid::make(2)
                            ->schema([
                                Forms\Components\TextInput::make('semester_info')
                                    ->label('Tahun Ajaran')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function () {
                                        $tahunAjaran = date('Y') . '/' . (date('Y') + 1);
                                        $semesterSekarang = (date('n') >= 8) ? 'Ganjil' : 'Genap';
                                        return "{$tahunAjaran} ({$semesterSekarang})";
                                    }),
                                
                                Forms\Components\TextInput::make('mahasiswa_count')
                                    ->label('Jumlah Mahasiswa Terdaftar')
                                    ->disabled()
                                    ->dehydrated(false)
                                    ->formatStateUsing(function ($record) {
                                        return $record->mahasiswa->count() . ' mahasiswa';
                                    }),
                            ]),
                    ]),
            ]);
    }

    public function infolist(Infolist $infolist): Infolist
    {
        return $infolist
            ->schema([
                Section::make('Mahasiswa Terdaftar')
                    ->description(function ($record) {
                        $jumlah = $record->mahasiswa->count();
                        if ($jumlah == 0) {
                            return "Belum ada mahasiswa yang terdaftar dalam jadwal kuliah ini";
                        }
                        return "Total {$jumlah} mahasiswa terdaftar dalam jadwal kuliah ini";
                    })
                    ->schema([
                        RepeatableEntry::make('mahasiswa')
                            ->schema([
                                Section::make()
                                    ->schema([
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('nim')
                                                    ->label('NIM')
                                                    ->formatStateUsing(fn ($state) => $state ?: 'NIM belum diisi')
                                                    ->badge()
                                                    ->color(fn ($state) => $state ? 'primary' : 'gray')
                                                    ->size('lg')
                                                    ->weight(FontWeight::Bold),
                                                TextEntry::make('user.name')
                                                    ->label('Nama Mahasiswa')
                                                    ->formatStateUsing(fn ($state) => $state ?: 'Nama belum diisi')
                                                    ->weight(FontWeight::SemiBold)
                                                    ->size('lg')
                                                    ->color(fn ($state) => $state ? 'primary' : 'gray'),
                                            ]),
                                        Grid::make(2)
                                            ->schema([
                                                TextEntry::make('kelas')
                                                    ->label('Kelas')
                                                    ->formatStateUsing(fn ($state) => $state ?: 'Kelas belum diisi')
                                                    ->badge()
                                                    ->color(fn ($state) => $state ? 'success' : 'gray')
                                                    ->icon('heroicon-o-academic-cap'),
                                                TextEntry::make('jurusan')
                                                    ->label('Program Studi')
                                                    ->formatStateUsing(fn ($state) => $state ?: 'Jurusan belum diisi')
                                                    ->badge()
                                                    ->color(fn ($state) => $state ? 'info' : 'gray')
                                                    ->icon('heroicon-o-building-library'),
                                            ]),
                                    ])
                                    ->compact()
                            ])
                            ->contained()
                            ->grid(2)
                            ->visible(fn ($record) => $record->mahasiswa->count() > 0),

                        // Tampilkan pesan jika tidak ada mahasiswa
                        TextEntry::make('empty_students')
                            ->label('')
                            ->formatStateUsing(fn () => 'Belum ada mahasiswa yang terdaftar dalam jadwal ini. Silakan tambahkan mahasiswa melalui halaman edit jadwal.')
                            ->badge()
                            ->color('gray')
                            ->icon('heroicon-o-exclamation-triangle')
                            ->visible(fn ($record) => $record->mahasiswa->count() === 0)
                    ])
                    ->collapsible()
                    ->icon('heroicon-o-users'),
            ]);
    }
}
